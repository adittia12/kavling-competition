<?php

namespace App\Exports;

use App\Models\TransactionValues;
use App\Models\Kavlings;
use App\Models\Directors;
use App\Models\ValueParameters;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RankKavlingExport implements FromView
{
    public function view(): View
    {
        // Ambil data yang diperlukan untuk export
        $kavlings = Kavlings::all();
        $parameters = ValueParameters::all();
        $directors = Directors::all();

        // Definisikan bobot untuk masing-masing parameter
        $bobot = [
            'Sustainable' => 0.15,
            '3R' => 0.30,
            'Estetika' => 0.25,
            'Vidio' => 0.30,
        ];

        // Array untuk menyimpan nilai dan total per kavling
        $rankingData = [];

        foreach ($kavlings as $kavling) {
            $nilaiPerParameter = [];
            $totalNilai = 0;

            foreach ($parameters as $parameter) {
                $nilaiPerParameter[$parameter->name_parameter] = 0;

                foreach ($directors as $director) {
                    // Ambil nilai dari transaction_value
                    $nilai = TransactionValues::where('id_kavling', $kavling->id)
                        ->where('id_parameter', $parameter->id)
                        ->where('id_direction', $director->id)
                        ->sum('value');

                    // Kalikan nilai dengan bobot parameter
                    $nilaiDenganBobot = $nilai * ($bobot[$parameter->name_parameter] ?? 1);

                    $nilaiPerParameter[$parameter->name_parameter] += $nilaiDenganBobot;
                    $totalNilai += $nilaiDenganBobot;
                }
            }

            // Simpan data kavling, nilai per parameter, dan total nilai
            $rankingData[] = [
                'kavling' => $kavling->name_kavling,
                'nilai_per_parameter' => $nilaiPerParameter,
                'total_nilai' => round($totalNilai), // Bulatkan nilai total
            ];
        }

        // Urutkan berdasarkan total nilai
        usort($rankingData, function ($a, $b) {
            return $b['total_nilai'] - $a['total_nilai'];
        });

        // Return view untuk export
        return view('exports.rank_kavling', [
            'rankingData' => $rankingData,
            'parameters' => $parameters,
        ]);
    }
}
