<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Directors;
use App\Models\Kavlings;
use App\Models\TransactionValues;
use App\Models\ValueParameters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\RankKavlingExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua kavling
        $kavlings = Kavlings::all();
        $directors = Directors::all(); // Ambil semua direksi

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
            $nilaiPerDireksi = [];
            $totalNilai = 0;

            foreach ($directors as $director) {
                // Ambil nilai yang diberikan oleh setiap direksi untuk kavling ini
                $nilaiPerParameter = [];

                foreach ($bobot as $parameterName => $bobotParameter) {
                    // Dapatkan nilai dari tabel berdasarkan parameter dan direksi
                    $nilai = TransactionValues::where('id_kavling', $kavling->id)
                        ->where('id_direction', $director->id)
                        ->whereHas('parameter', function ($query) use ($parameterName) {
                            $query->where('name_parameter', $parameterName);
                        })
                        ->sum('value');

                    // Kalikan nilai dengan bobot parameter
                    $nilaiDenganBobot = $nilai * $bobotParameter;

                    // Simpan nilai berdasarkan parameter yang dinilai
                    $nilaiPerParameter[$parameterName] = $nilaiDenganBobot;

                    // Tambahkan nilai ke total nilai keseluruhan
                    $totalNilai += $nilaiDenganBobot;
                }

                // Tambahkan nilai per direksi
                $nilaiPerDireksi[$director->name] = $nilaiPerParameter;
            }

            // Simpan data kavling, nilai per direksi, dan total nilai
            $rankingData[] = [
                'kavling' => $kavling->name_kavling,
                'nilai_per_direksi' => $nilaiPerDireksi,
                'total_nilai' => round($totalNilai), // Bulatkan nilai total
            ];
        }

        // Urutkan berdasarkan total nilai dari yang tertinggi ke terendah
        usort($rankingData, function ($a, $b) {
            return $b['total_nilai'] - $a['total_nilai']; // Urutkan descending
        });

        return view('transaction.index', compact('rankingData', 'directors', 'bobot'));
    }


    public function displayRank()
    {
        // Ambil semua kavling
        $kavlings = Kavlings::all();
        $parameters = ValueParameters::all(); // Ambil semua parameter
        $directors = Directors::all(); // Ambil semua direksi

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
            $nilaiPerDireksi = [];
            $totalNilai = 0;
            $nilaiPerParameter = [];

            foreach ($parameters as $parameter) {
                $nilaiPerDireksi[$parameter->name_parameter] = [];

                foreach ($directors as $director) {
                    // Ambil nilai yang diberikan oleh setiap direksi untuk kavling ini berdasarkan parameter
                    $nilai = TransactionValues::where('id_kavling', $kavling->id)
                        ->where('id_direction', $director->id)
                        ->where('id_parameter', $parameter->id)
                        ->sum('value'); // Menghitung total nilai untuk setiap parameter

                    // Kalikan nilai dengan bobot parameter
                    $nilaiDenganBobot = $nilai * ($bobot[$parameter->name_parameter] ?? 1);

                    // Simpan nilai untuk setiap parameter yang dinilai oleh direksi
                    $nilaiPerDireksi[$parameter->name_parameter][$director->name] = $nilaiDenganBobot;

                    // Tambahkan ke total nilai untuk parameter ini
                    if (!isset($nilaiPerParameter[$parameter->name_parameter])) {
                        $nilaiPerParameter[$parameter->name_parameter] = 0;
                    }
                    $nilaiPerParameter[$parameter->name_parameter] += $nilaiDenganBobot;

                    // Tambahkan ke total nilai keseluruhan untuk kavling ini
                    $totalNilai += $nilaiDenganBobot;
                }
            }

            // Simpan data kavling, nilai per direksi, per parameter, dan total nilai
            $rankingData[] = [
                'kavling' => $kavling->name_kavling,
                'nilai_per_direksi' => $nilaiPerDireksi,
                'nilai_per_parameter' => $nilaiPerParameter,
                'total_nilai' => round($totalNilai), // Bulatkan nilai total
            ];
        }

        // Urutkan berdasarkan total nilai dari yang tertinggi ke terendah
        usort($rankingData, function ($a, $b) {
            return $b['total_nilai'] - $a['total_nilai']; // Urutkan descending
        });

        return view('transaction.show_rank', compact('rankingData', 'directors', 'parameters'));
    }

    public function viewTransaction()
    {
        $dataTransaction = TransactionValues::join('kavling', 'transaction_value.id_kavling', '=', 'kavling.id')
                            ->join('directors', 'transaction_value.id_direction', '=', 'directors.id')
                            ->join('value_parameter', 'transaction_value.id_parameter', '=', 'value_parameter.id')
                            ->select('kavling.name_kavling', 'directors.name as name_director', 'value_parameter.name_parameter', 'transaction_value.value', 'transaction_value.id as id_transaction')
                            ->when(request('q'), function($query) {
                                $query->where('kavling.name_kavling', 'like', '%' . request('q') . '%')
                                    ->orWhere('name_director', 'like', '%' . request('q') . '%')
                                    ->orWhere('value_parameter.name_parameter', 'like', '%' . request('q') . '%');
                            })->orderBy('transaction_value.created_at')->paginate(20);

        return view('transaction.view_data_transaction', compact('dataTransaction'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kavlingList = Kavlings::all();

        return view('transaction.components.view_add_transaction', compact(['kavlingList']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            foreach ($request->value as $key => $value) {
                // Ambil ID kavling dari request
                $kavlingId = $request->input('kavling_id.' . $key);

                // Simpan nilai ke database
                TransactionValues::create([
                    'id_kavling' => $kavlingId,   // Simpan ID kavling
                    'value' => $value,            // Simpan nilai yang diberikan
                    'id_direction' => 6,  // Ambil ID direksi (misalnya user login)
                    'id_parameter' => 4,  // Jika ada parameter nilai
                ]);
            }

            DB::commit(); // Commit transaksi jika berhasil
            Alert::success('Berhasil', 'Data Berhasil ditambah');
            return redirect()->route('transaction_datavalue');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback transaksi jika ada kesalahan
            Alert::error('Gagal', 'Data gagal ditambah!');
            return redirect()->back();
        }
    }

    public function exportRanking()
    {
        $timestamp = date('Y-m-d_H-i-s');
        return Excel::download(new RankKavlingExport, 'ranking_kavling ' . $timestamp . '.xlsx');
    }


    /**
     * Display the specified resource.
     */
    public function show(TransactionValues $transactionValues)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionValues $transactionValues)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionValues $transactionValues)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $check = TransactionValues::where('id', $id)->first();
        $check->delete();

        if ($check) {
            Alert::success('Berhasil', 'Data Transaksi berhasil dihapus!');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Data gagal dihapus!');
            return redirect()->back();
        }
    }
}
