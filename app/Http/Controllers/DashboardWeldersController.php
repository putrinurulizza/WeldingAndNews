<?php

namespace App\Http\Controllers;

use App\Models\Welder;
use Illuminate\Http\Request;

class DashboardWeldersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $welders = Welder::all();
        return view('dashboard.welders.index')->with(compact('welders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.welders.create');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Welder $welder)
    {
        return view('dashboard.welders.edit')->with(compact('welder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
