<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

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
        $event = Event::create($request->only('title', 'description', 'location', 'date', 'creatorId'));
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
}
