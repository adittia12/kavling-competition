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

                    $nilaiPerParameter[$parameter->name_parameter] += $nilai;
                    $totalNilai += $nilai;
                }
            }

            $rankingData[] = [
                'kavling' => $kavling->name_kavling,
                'nilai_per_parameter' => $nilaiPerParameter,
                'total_nilai' => $totalNilai,
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
