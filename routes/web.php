<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/verify-email/{token}', [MailController::class, 'verifyEmail'])->name('verify.email');
Route::get('/reset-password/{token}', [MailController::class,'resetPassword'])->name('reset.password');




