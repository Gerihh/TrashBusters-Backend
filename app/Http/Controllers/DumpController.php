<?php

namespace App\Http\Controllers;

use App\Models\Dump;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $dump = Dump::find($dump->id);

        if ($dump == null) {
            return response()->json(['message' => 'Nincs ilyen lerakó'], 404);
        } else {
            $dump->delete();
            return response()->json(['message' => 'Sikeres törlés'], 200);
        }
    }

    public function getDumpNameById(Request $request, $dumpId)
    {
        $validator = Validator::make(['dumpId' => $dumpId], [
            'dumpId' => 'integer|exists:dumps,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Nincs lerakó ilyen azonosítóval'], 400);
        }

        $dump = Dump::find($dumpId);
        return response()->json($dump->name);
    }
}
