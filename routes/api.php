<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user', [AuthController::class, 'user']);

    Route::middleware('auth:api')->group(function () {

    });
});


Route::apiResource('users', UserController::class);
Route::apiResource('events', EventController::class);
Route::apiResource('participants', ParticipantController::class);

Route::get('/event/participants/{eventId}', [ParticipantController::class, 'getByEventId']);
Route::get('/participants/user/{userId}', [ParticipantController::class, 'getByUserId']);

Route::get('/events/creator/{creatorId}', [EventController::class, 'getEventByCreatorId']);
Route::get('/participants/events/joined/{userId}', [ParticipantController::class, 'eventsJoinedByUser']);

Route::get('/participants/check/{eventId}/{userId}', [ParticipantController::class,'pairExists']);

Route::delete('/participants/delete/{eventId}/{userId}', [ParticipantController::class, 'destroy']);

Route::get(`/participants/user/{userId}/events`, [ParticipantController::class, 'getEventsByUser']);

Route::patch('/events/{event}/participant-left', [EventController::class, 'decrementParticipants']);

Route::get('/users/username/{username}', [UserController::class, 'getUserByUsername']);