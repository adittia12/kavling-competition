<?php

namespace App\Http\Controllers;

use App\Models\Directors;
use App\Models\Kavlings;
use App\Models\TransactionValues;
use App\Models\ValueParameters;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DisplayCompetitionController extends Controller
{
    public function displayDireksi()
    {
        $dataDireksi = Directors::select('*')->limit(5)->get();
        return view('welcome', compact(['dataDireksi']));
    }

    public function displayKavling($id)
    {
        $dataKavling = Kavlings::all();
        $dataDireksi = Directors::find($id);

        // Buat array untuk menyimpan total nilai setiap kavling
        $nilaiPerKavling = [];

        foreach ($dataKavling as $kavling) {
            // Hitung total nilai yang diberikan untuk kavling ini oleh direksi
            $totalNilai = TransactionValues::where('id_kavling', $kavling->id)
                ->where('id_direction', $id) // Berdasarkan direksi
                ->sum('value'); // Hitung jumlah nilai

            // Hitung jumlah parameter yang sudah dinilai
            $jumlahParameterDinilai = TransactionValues::where('id_kavling', $kavling->id)
                ->where('id_direction', $id)
                ->count();

            // Simpan total nilai dan status apakah semua parameter sudah dinilai atau belum
            $nilaiPerKavling[$kavling->id] = [
                'total_nilai' => $totalNilai,
                'dinilai' => ($jumlahParameterDinilai >= 3) // Misalnya 3 parameter
            ];
        }

        return view('competition.display_kavling', compact(['dataKavling', 'dataDireksi', 'nilaiPerKavling']));
    }

    public function displayPenilaian($id_kavling, $id_direksi)
    {
        // Mengambil data parameter nilai
        $parameters = ValueParameters::select('*')->limit(3)->get();

        // Mengambil data direksi berdasarkan ID
        $direksi = Directors::find($id_direksi);

        // Mengambil data kavling berdasarkan ID
        $kavling = Kavlings::find($id_kavling);

        return view('competition.display_penilaian', data: compact('parameters', 'direksi', 'kavling'));
    }

    public function storePenilaian(Request $request, $dir_id)
    {
        // Temukan data direksi berdasarkan ID
        $direksi = Directors::find($dir_id);

        // Pastikan data direksi ditemukan
        if (!$direksi) {
            return redirect()->back()->withErrors(['error' => 'Direksi tidak ditemukan']);
        }

        // Validasi input
        $validated = $request->validate([
            'kavling_id' => 'required|integer|exists:kavling,id', // Validasi bahwa kavling_id valid
            'direksi_id' => 'required|integer|exists:directors,id', // Validasi bahwa direksi_id valid
            'values' => 'required|array',  // Pastikan values adalah array
            'values.*' => 'required|numeric|min:70|max:100', // Validasi setiap elemen values
        ]);

        // Simpan setiap nilai yang diinputkan untuk setiap parameter
        foreach ($validated['values'] as $parameter_id => $value) {
            TransactionValues::create([
                'id_kavling' => $validated['kavling_id'],
                'id_direction' => $validated['direksi_id'],  // 'id_direction' disesuaikan dengan kolom di database
                'id_parameter' => $parameter_id,  // ID parameter dari input values
                'value' => $value,
            ]);
        }

        // Tampilkan alert sukses
        Alert::success('Success', 'Berhasil memberikan nilai');

        // Redirect ke halaman data kavling
        return redirect()->route('kavling_data', ['id' => $dir_id]);
    }



}
