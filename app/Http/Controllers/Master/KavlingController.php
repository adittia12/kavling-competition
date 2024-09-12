<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kavlings;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(Kavlings $kavlings)
    {
        //
    }
}
