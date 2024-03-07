<?php

namespace App\Http\Controllers;

use App\Models\Dump;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DumpController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/dumps",
 *     summary="Lerakók listázása",
 *     description="Az összes lerakó listázása",
 *     tags={"Lerakók"},
 *     @OA\Response(
 *         response=200,
 *         description="Sikeres lekérés",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="name", type="string"),
 *                 @OA\Property(property="description", type="string"),
 *                 @OA\Property(property="location", type="string"),
 *                 @OA\Property(property="contactPhone", type="string"),
 *                 @OA\Property(property="contactEmail", type="string"),
 *             ),
 *         ),
 *     ),
 * )
 */
    public function index()
    {
        $dumps = Dump::all();
        return response()->json($dumps);
    }

    public function store(Request $request)
    {
        $dump = Dump::create($request->all());
        return response()->json($dump, 201);
    }

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
    /**
 * @OA\Get(
 *     path="/api/dump/name/{dumpId}",
 *     summary="Lerakó nevének lekérdezése",
 *     description="Lerakó nevének lekérdezése id alapján",
 *     tags={"Lerakók"},
 *     @OA\Parameter(
 *         name="dumpId",
 *         in="path",
 *         required=true,
 *         description="Lerakó azoosítója",
 *         @OA\Schema(type="integer"),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Sikeres lekérés",
 *         @OA\JsonContent(
 *             type="string",
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Hibás kérés",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string"),
 *         ),
 *     ),
 * )
 */
    public function getDumpNameById(Request $request, $dumpId)
    {
        $validator = Validator::make(['dumpId' => $dumpId], [
            'dumpId' => 'integer|exists:dumps,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Nincs lerakó ilyen azonosítóval'], 400);
        }

        $dump = Dump::find($dumpId);
        return response()->json($dump->name, 200);
    }
}
