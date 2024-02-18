<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
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

            return view('email-verification.success'); // You can customize this view
        } else {
            return view('email-verification.invalid'); // You can customize this view
        }
    }
}