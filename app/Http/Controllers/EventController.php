<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create($request->only(['title', 'description', 'location', 'place', 'date', 'time', 'creatorId']));
        return response()->json($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event = Event::find($event->id);
        if ($event == null) {
            return response()->json(['message' => 'Nincs ilyen esemény'], 404);
        } else {
            return response()->json($event);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event = Event::find($event->id);
        if ($event == null) {
            return response()->json(['message' => 'Nincs ilyen esemény'], 404);
        } else {
            $event->update($request->all());
            return response()->json($event);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event = Event::find($event->id);

        if ($event == null) {
            return response()->json(['message' => 'Nincs ilyen esemény'], 404);
        } else {
            $event->delete();
            return response()->json(['message' => 'Esemény törölve'], 200);
        }
    }

    public function getEventByCreatorId(Request $request, $creatorId)
    {
        $events = Event::where('creatorId', $creatorId)->select('id', 'title', 'description', 'participants', 'location', 'place', 'date', 'time', 'creatorId')->get();
        if ($events->isEmpty()) {
            return response()->json(['message' => 'Nincs ilyen esemény'], 404);
        } else {
            return response()->json($events);
        }
    }

    public function decrementParticipants(Event $event)
{
    // Assuming your events table has a 'participants' column
    $event->decrement('participants');

    return response()->json(['message' => 'Participant count decremented successfully']);
}

    public function getEventWithMostParticipants()
    {
        $event = Event::orderBy('participants', 'desc')->first();

        return response()->json($event);
    }

    public function getLatestEvent()
    {
        $event = Event::orderBy('id', 'desc')->first();

        return response()->json($event);
    }

    public function getClosestEvent()
    {
        $event = Event::orderBy('date', 'asc')->first();

        return response()->json($event);
    }

}
