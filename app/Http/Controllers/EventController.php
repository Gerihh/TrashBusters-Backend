<?php

namespace App\Http\Controllers;


use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class EventController extends Controller
{
    /**
     * @OA\Get(
     *  path="/api/events",
     *  summary="Események listázása",
     *  description="Az összes esemény listázása",
     *  tags={"Események"},
     *      @OA\Response(
     *          response=200,
     *          description="Sikeres lekérés",
     *          @OA\JsonContent(
     *                  type="array",
     *                  @OA\Items(
     *                          type="object",
     *                              @OA\Property(property="id", type="integer"),
     *                              @OA\Property(property="title", type="string"),
     *                              @OA\Property(property="description", type="string"),
     *                              @OA\Property(property="date", type="string"),
     *                              @OA\Property(property="time", type="string"),
     *                              @OA\Property(property="location", type="string"),
     *                              @OA\Property(property="place", type="string"),
     *                              @OA\Property(property="participants", type="integer"),
     *                              @OA\Property(property="creatorId", type="integer"),
     *                              @OA\Property(property="dumpId", type="integer"),
     *                              @OA\Property(property="eventPictureURL", type="string"),
     *                          ),
     *                      ),
     *                  ),
     *              ),
     */
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }
    /**
     * @OA\Post(
     *     path="/api/events",
     *     summary="Esemény létrehozása",
     *     description="Új esemény létrehozása",
     *     tags={"Események"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string", example="Szemétszedés"),
     *                 @OA\Property(property="description", type="string", example=""),
     *                 @OA\Property(property="location", type="string", example="Budapest"),
     *                 @OA\Property(property="place", type="string", example="Hősök tere"),
     *                 @OA\Property(property="date", type="string", example="2024-07-12"),
     *                 @OA\Property(property="time", type="string", example="16:00"),
     *                 @OA\Property(property="creatorId", type="integer", example="1"),
     *                 @OA\Property(property="dumpId", type="integer", example=""),
     *                 @OA\Property(property="eventPicture", type="file", example=""),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres esemény létrehozása",
     *         @OA\JsonContent(
     *             @OA\Property(property="event", type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="location", type="string"),
     *                 @OA\Property(property="place", type="string"),
     *                 @OA\Property(property="date", type="string"),
     *                 @OA\Property(property="time", type="string"),
     *                 @OA\Property(property="participants", type="integer"),
     *                 @OA\Property(property="creatorId", type="integer"),
     *                 @OA\Property(property="dumpId", type="integer"),
     *                 @OA\Property(property="eventPictureURL", type="string"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Sikertelen esemény létrehozása",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Nem feldolgozható tartalom",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object",
     *             @OA\Property(property="eventPicture", type="array",
     *                 @OA\Items(type="string"),
     *                 @OA\Items(type="string")
     *             ),
     *         ),
     *     ),
     * )
     * )
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
     * @OA\Get(
     *     path="/api/events/{id}",
     *     summary="Esemény lekérdezése",
     *     description="Esemény lekérdezése id alapján",
     *     tags={"Események"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Az esemény azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérdezés",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="date", type="string"),
     *             @OA\Property(property="time", type="string"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="place", type="string"),
     *             @OA\Property(property="participants", type="integer"),
     *             @OA\Property(property="creatorId", type="integer"),
     *             @OA\Property(property="dumpId", type="integer"),
     *             @OA\Property(property="eventPictureURL", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nincs esemény ilyen azonosítóval",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
    public function show($eventId)
    {
        $event = Event::find($eventId);

        if ($event === null) {
            return response()->json(['error' => 'Nincs ilyen esemény'], 404);
        }
        return response()->json($event, 200);
    }
    /**
     * @OA\Put(
     *     path="/api/events/{id}",
     *     summary="Esemény módosítása",
     *     description="Esemény módosítása azonosító alapján",
     *     tags={"Események"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Az esemény azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string", example="Módosított cím"),
     *                 @OA\Property(property="description", type="string", example="Módosított leírás"),
     *                 @OA\Property(property="location", type="string", example="Módosított helyszín"),
     *                 @OA\Property(property="place", type="string", example="Módosított hely"),
     *                 @OA\Property(property="date", type="string", example="2022-12-12"),
     *                 @OA\Property(property="time", type="string", example="18:00"),
     *                 @OA\Property(property="creatorId", type="integer", example="2"),
     *                 @OA\Property(property="dumpId", type="integer", example="2"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres esemény módosítás",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="date", type="string"),
     *             @OA\Property(property="time", type="string"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="place", type="string"),
     *             @OA\Property(property="participants", type="integer"),
     *             @OA\Property(property="creatorId", type="integer"),
     *             @OA\Property(property="dumpId", type="integer"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Az esemény nem található",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     * )
     */
    public function update(Request $request, $eventId)
    {
        $event = Event::find($eventId);
        if ($event == null) {
            return response()->json(['message' => 'Nincs ilyen esemény'], 404);
        } else {
            $event->update($request->all());
            return response()->json($event, 200);
        }
    }
    /**
     * @OA\Delete(
     *     path="/api/events/{id}",
     *     summary="Esemény törlése",
     *     description="Esemény törlése azonosító alapján",
     *     tags={"Események"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Az esemény azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres esemény törlés",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Az esemény nem található",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
    public function destroy($eventId)
    {
        $event = Event::find($eventId);

        if ($event == null) {
            return response()->json(['error' => 'Nincs ilyen esemény'], 404);
        } else {
            $event->delete();
            return response()->json(['message' => 'Esemény törölve'], 200);
        }
    }
    /**
     * @OA\Get(
     *     path="/api/events/creator/{creatorId}",
     *     summary="Események lekérése szervező azonosítója alapján",
     *     description="Események lekérése szervező azonosítója alapján",
     *     tags={"Események"},
     *     @OA\Parameter(
     *         name="creatorId",
     *         in="path",
     *         required=true,
     *         description="A szervező azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="participants", type="integer"),
     *                 @OA\Property(property="location", type="string"),
     *                 @OA\Property(property="place", type="string"),
     *                 @OA\Property(property="date", type="string"),
     *                 @OA\Property(property="time", type="string"),
     *                 @OA\Property(property="creatorId", type="integer"),
     *                 @OA\Property(property="eventPictureURL", type="string"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Érvénytelen kérés",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
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
    /**
     * @OA\Get(
     *     path="/api/event/most-participants",
     *     summary="Esemény lekérése a legtöbb résztvevővel",
     *     description="Esemény lekérése a legtöbb résztvevővel",
     *     tags={"Események"},
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="participants", type="integer"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="place", type="string"),
     *             @OA\Property(property="date", type="string"),
     *             @OA\Property(property="time", type="string"),
     *             @OA\Property(property="creatorId", type="integer"),
     *             @OA\Property(property="eventPictureURL", type="string"),
     *         ),
     *     ),
     * )
     */
    public function getEventWithMostParticipants()
    {
        $event = Event::orderBy('participants', 'desc')->first();

        return response()->json($event);
    }
    /**
     * @OA\Get(
     *     path="/api/event/latest",
     *     summary="Legfrissebb esemény lékérése",
     *     description="Legfrissebb esemény lékérése",
     *     tags={"Események"},
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="participants", type="integer"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="place", type="string"),
     *             @OA\Property(property="date", type="string"),
     *             @OA\Property(property="time", type="string"),
     *             @OA\Property(property="creatorId", type="integer"),
     *             @OA\Property(property="eventPictureURL", type="string"),
     *         ),
     *     ),
     * )
     */
    public function getLatestEvent()
    {
        $event = Event::orderBy('id', 'desc')->first();

        return response()->json($event);
    }
    /**
     * @OA\Get(
     *     path="/api/event/closest",
     *     summary="Időben legközelebbi esemény lekérése",
     *     description="Időben legközelebbi esemény lévő esemény lekérése",
     *     tags={"Események"},
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="participants", type="integer"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="place", type="string"),
     *             @OA\Property(property="date", type="string"),
     *             @OA\Property(property="time", type="string"),
     *             @OA\Property(property="creatorId", type="integer"),
     *             @OA\Property(property="eventPictureURL", type="string"),
     *         ),
     *     ),
     * )
     */
    public function getClosestEvent()
    {
        $event = Event::orderBy('date', 'asc')->first();

        return response()->json($event);
    }
}
