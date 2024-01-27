<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

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

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        //
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
        $participants = Participant::where('userId', $userId)
        ->with(['event' => function ($query) {
            // Select only the columns you need from the 'events' table
            $query->select('id', 'title', 'description', 'participants', 'location', 'place', 'date', 'time', 'creatorId');
        }])
        ->get();

    if ($participants->isEmpty()) {
        return response()->json(['message' => 'User has not joined any events.'], 404);
    }

    // Extract only the 'event' data from each participant
    $eventsJoinedByUser = $participants->map(function ($participant) {
        return $participant->event;
    });

    return response()->json($eventsJoinedByUser);
    }
}
