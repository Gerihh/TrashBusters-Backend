<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetEmail;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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

        if ($user) {
            // Update user status to indicate verification
            $user->update(['isVerified' => true, 'verificationToken' => null]);

            return redirect()->away('http://localhost:9000/#/login');
        } else {
            return view('email-verification.invalid');
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

        if ($user) {
            return redirect()->away('http://localhost:9000/#/password-recovery/' . $user->passwordResetToken);
        } else {
            return view('email-verification.invalid');
        }
    }
}
