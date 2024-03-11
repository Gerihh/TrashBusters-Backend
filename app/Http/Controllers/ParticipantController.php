<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{

    public function store(Request $request)
    {
        $participant = Participant::create($request->all());
        return response()->json($participant, 201);
    }

    public function destroy($eventId, $userId)
    {
        $participant = Participant::where([
            'eventId' => $eventId,
            'userId' => $userId,
        ]);

        if ($participant === null) {
            return response()->json(['message' => 'Participant not found'], 404);
        }

        $deleted = $participant->delete();

        if ($deleted) {
            return response()->json(['message' => 'Participant deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to delete participant'], 500);
        }
    }
    /**
     * @OA\Get(
     *     path="/api/event/participants/{eventId}",
     *     summary="Résztvevők azonosítójának listázása egy eseményhez",
     *     description="Résztvevők azonosítójának listázása egy eseményhez azonosító alapján",
     *     tags={"Résztvevők"},
     *     @OA\Parameter(
     *         name="eventId",
     *         in="path",
     *         required=true,
     *         description="Az esemény azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés esetén a résztvevők listája",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="eventId", type="integer"),
     *                 @OA\Property(property="userId", type="integer"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Érvénytelen esemény azonosító esetén a hibaüzenet",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
    public function getByEventId($eventId)
    {
        $validator = Validator::make(['eventId' => $eventId], [
            'eventId' => 'integer|exists:events,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => "Nincs ilyen esemény"], 400);
        }

        $participants = Participant::where('eventId', $eventId)->get();

        return response()->json($participants, 200);
    }
    /**
     * @OA\Get(
     *     path="/api/participants/user/{userId}",
     *     summary="Események azonosítójának lekérése egy felhasználóhoz",
     *     description="Események azonosítójának lekérése egy felhasználóhoz azonosító alapján",
     *     tags={"Résztvevők"},
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         required=true,
     *         description="A felhasználó azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés esetén a résztvevők listája",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="eventId", type="integer"),
     *                 @OA\Property(property="userId", type="integer"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Érvénytelen felhasználó azonosító esetén a hibaüzenet",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
    public function getByUserId($userId)
    {
        $validator = Validator::make(['userId' => $userId], [
            'userId' => 'integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Nincs ilyen felhasználó'], 400);
        }

        $participants = Participant::where('userId', $userId)->get();

        return response()->json($participants, 200);
    }
    /**
     * @OA\Get(
     *     path="/api/participants/events/joined/{userId}",
     *     summary="Események lekérése egy felhasználóhoz",
     *     description="Események lekérése egy felhasználóhoz azonosító alapján",
     *     tags={"Résztvevők"},
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         required=true,
     *         description="A felhasználó azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés esetén a felhasználó által csatlakozott események listája",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="participants", type="integer"),
     *                 @OA\Property(property="location", type="string"),
     *                 @OA\Property(property="place", type="string"),
     *                 @OA\Property(property="date", type="string", format="date"),
     *                 @OA\Property(property="time", type="string", format="time"),
     *                 @OA\Property(property="creatorId", type="integer"),
     *                 @OA\Property(property="dumpId", type="integer"),
     *                 @OA\Property(property="eventPictureURL", type="string"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Érvénytelen felhasználó azonosító esetén a hibaüzenet",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
    public function eventsJoinedByUser(Request $request, $userId)
    {
        $validator = Validator::make(['userId' => $userId], [
            'userId' => 'integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Nincs ilyen felhasználó'], 400);
        }

        $participants = Participant::where('userId', $userId)
            ->with(['event' => function ($query) {
                $query->select('id', 'title', 'description', 'participants', 'location', 'place', 'date', 'time', 'creatorId', 'dumpId', 'eventPictureURL');
            }])
            ->get();

        $eventsJoinedByUser = $participants->map(function ($participant) {
            return $participant->event;
        });

        return response()->json($eventsJoinedByUser);
    }
    /**
     * @OA\Get(
     *     path="/api/participants/check/{eventId}/{userId}",
     *     summary="Ellenőrzi, hogy a résztvevő pár létezik-e",
     *     description="Ellenőrzi, hogy a résztvevő pár létezik-e",
     *     tags={"Résztvevők"},
     *     @OA\Parameter(
     *         name="eventId",
     *         in="path",
     *         required=true,
     *         description="Az esemény azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         required=true,
     *         description="A felhasználó azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés esetén a pár létezésének állapota",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="exists", type="boolean"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Érvénytelen esemény vagy felhasználó azonosító esetén a hibaüzenet",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
    public function pairExists($eventId, $userId)
    {
        $userValidator = Validator::make(['userId' => $userId], [
            'userId' => 'integer|exists:users,id',
        ]);

        if ($userValidator->fails()) {
            return response()->json(['error' => 'Nincs ilyen felhasználó'], 400);
        }

        $eventValidator = Validator::make(['eventId' => $eventId], [
            'eventId' => 'integer|exists:events,id',
        ]);

        if ($eventValidator->fails()) {
            return response()->json(['error' => 'Nincs ilyen esemény'], 400);
        }

        $exists = Participant::where('eventId', $eventId)->where('userId', $userId)->exists();

        return response()->json(['exists' => $exists], 200);
    }
    /**
     * @OA\Get(
     *     path="/api/participants/event/{eventId}",
     *     summary="Résztvevők lekérése egy eseményhez",
     *     description="Résztvevők lekérése egy eseményhez azonosító alapján",
     *     tags={"Résztvevők"},
     *     @OA\Parameter(
     *         name="eventId",
     *         in="path",
     *         required=true,
     *         description="Az esemény azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés esetén a résztvevők és a résztvevők számának adatai",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="users", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="username", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="city", type="string"),
     *                 @OA\Property(property="isVerified", type="boolean"),
     *                 @OA\Property(property="profilePictureURL", type="string"),
     *
     *             )),
     *             @OA\Property(property="count", type="integer"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Hibás kérés esetén az error üzenet",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     *  )
     */
    public function getParticipantsByEventId($eventId)
    {
        $validator = Validator::make(['eventId' => $eventId], [
            'eventId' => 'integer|exists:events,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Nincs ilyen esemény'], 400);
        }

        $participants = Participant::with('user:id,username,email,city,isVerified,profilePictureURL')->where('eventId', $eventId)->get();

        $users = $participants->pluck('user');

        $response = [
            'users' => $users,
            'count' => $participants->count(),
        ];

        return response()->json($response, 200);
    }
}
