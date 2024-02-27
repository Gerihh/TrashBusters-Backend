<?php

namespace App\Http\Controllers;

use App\Models\Dump;
use Illuminate\Http\Request;

class DumpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dumps = Dump::all();
        return response()->json($dumps);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dump = Dump::create($request->all());
        return response()->json($dump, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dump $dump)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dump $dump)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dump $dump)
    {
        //
    }
}
