<?php

namespace App\Http\Controllers;


use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


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
        $event = Event::create($request->only(['title', 'description', 'location', 'place', 'date', 'time', 'creatorId', 'dumpId']));

        $request->validate([
            'eventPicture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('eventPicture')) {
            $file = $request->file('eventPicture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $folder = 'event-pictures';

            $file->storePubliclyAs($folder, $filename, 's3');

            $url = Storage::disk('s3')->url($folder . '/' . $filename);

            $event->update(['eventPictureURL' => $url]);
            return response()->json(['message' => 'File uploaded successfully', 'url' => $url], 200);
        }
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
        $validator = Validator::make(['creatorId' => $creatorId], [
            'creatorId' => 'integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Nincs ilyen felhasználó'], 400);
        }

        $events = Event::where('creatorId', $creatorId)
            ->select('id', 'title', 'description', 'participants', 'location', 'place', 'date', 'time', 'creatorId', 'eventPictureURL')
            ->get();

        return response()->json($events);
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
