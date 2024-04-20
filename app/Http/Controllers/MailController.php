<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetEmail;
use App\Mail\ProfileDeletionEmail;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function sendVerificationEmail($user)
    {
        $verificationLink = route('verify.email', ['token' => $user->verificationToken]);

        Mail::to($user->email)->send(new VerificationEmail($verificationLink));
    }
    public function verifyEmail($token)
    {
        $user = User::where('verificationToken', $token)->first();
        $URL = env('APP_URL');

        if ($user) {
            $user->update(['isVerified' => true, 'verificationToken' => null]);

            $redirectUrl = $URL . ':8100';

            return redirect()->away($redirectUrl);
        } else {
            return response()->json(['error' => 'Érvénytelen token'], 200);
        }
    }


    public function sendPasswordResetEmail($user)
    {
        $resetLink = route('reset.password', ['token' => $user->passwordResetToken]);

        Mail::to($user->email)->send(new PasswordResetEmail($resetLink));
    }

    public function resetPassword($token)
    {
        $user = User::where('passwordResetToken', $token)->first();
        $URL = env('APP_URL');
        if ($user) {
            $redirectUrl = $URL . ':8100/recovery/'. $user->passwordResetToken;
            return redirect()->away($redirectUrl);
        } else {
            return view('email-verification.invalid');
        }
    }

    public function sendProfileDeletionCodeEmail($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            // Handle the case where the user with the given ID is not found
            return response()->json(['message' => 'User not found.'], 404);
        }

        $deletionCode = strtoupper(Str::random(6, 'alnum'));

        Cache::put('deletion_code_' . $user->id, $deletionCode, now()->addMinutes(10));

        Mail::to($user->email)->send(new ProfileDeletionEmail($user, $deletionCode));

        return response()->json(['message' => 'Email elküldve!'], 200);
    }
}
