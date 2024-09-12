<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\ValueParameters;
use Illuminate\Http\Request;

class ValueParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataParameter = ValueParameters::when(request('q'), function($query) {
            $query = $query->where('name_parameter', 'like', '%' . request('q') . '%');
        })->latest()->paginate(15);

        return view('master.parameter.index', compact(['dataParameter']));
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
    public function show(ValueParameters $valueParameters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ValueParameters $valueParameters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ValueParameters $valueParameters)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ValueParameters $valueParameters)
    {
        //
    }
}
