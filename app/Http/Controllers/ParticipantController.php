<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

        // Check if the participant record exists
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

    public function getByEventId(Request $request, $eventId)
    {
        $participants = Participant::where('eventId', $eventId)->get();
        if ($participants->isEmpty()) {
            return response()->json(['message' => 'Nincs ilyen esemény'], 404);
        }
        return response()->json($participants, 200);
    }

    public function getByUserId(Request $request, $userId)
    {
        $participants = Participant::where('userId', $userId)->get();
        if ($participants->isEmpty()) {
            return response()->json(['message' => 'Nincs ilyen résztvevő'], 404);
        }
        return response()->json($participants, 200);
    }

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
                $query->select('id', 'title', 'description', 'participants', 'location', 'place', 'date', 'time', 'creatorId', 'eventPictureURL');;
            }])
            ->get();

        $eventsJoinedByUser = $participants->map(function ($participant) {
            return $participant->event;
        });

        return response()->json($eventsJoinedByUser);
    }
    public function pairExists($eventId, $userId)
    {
        // Validate that $userId is a valid integer
        $validator = Validator::make(['userId' => $userId], [
            'userId' => 'integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid userId'], 400);
        }

        // Validate that $eventId is a valid integer
        $validator = Validator::make(['eventId' => $eventId], [
            'eventId' => 'integer|exists:events,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid eventId'], 400);
        }

        // If validation passes, proceed with checking if the pair exists
        $exists = Participant::where('eventId', $eventId)->where('userId', $userId)->exists();

        return response()->json(['exists' => $exists], 200);
    }

    public function getParticipantsByEventId($eventId)
    {
        $participants = Participant::with('user')->where('eventId', $eventId)->get();

        $users = $participants->pluck('user');

        $response = [
            'users' => $users,
            'count' => $participants->count(),
        ];

        return response()->json($response, 200);
    }
}
