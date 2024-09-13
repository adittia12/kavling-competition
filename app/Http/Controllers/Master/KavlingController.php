<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kavlings;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KavlingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kavlingData = Kavlings::when(request('q'), function($query) {
            $query = $query->where('name_kavling', 'like', '%' . request('q') . '%');
        })->latest()->paginate(15);

        return view('master.kavling.index', compact(['kavlingData']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.kavling.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_kavling' => 'required'
        ]);

        $check = Kavlings::create($request->all());

        if ($check) {
            Alert::success('Berhasil', 'Data berhasil ditamabh');
            return redirect()->route('kavling.index');
        } else {
            Alert::error('Gagal', 'Data gagal ditambah');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kavlings $kavlings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kavlings $kavlings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kavlings $kavlings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kavling)
    {
        $check = Kavlings::where('id', $kavling)->first();
        $check->delete();

        if ($check) {
            Alert::success('Berhasil', 'Data berhasil dihapus');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Data gagal dihapus');
            return redirect()->back();
        }
    }
}
