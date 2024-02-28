<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\NewUserRequest;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(NewUserRequest $request)
    {
        //Validálás
        $verificationToken = Str::random(32);

        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $data['verificationToken'] = $verificationToken;
        $data['isVerified'] = false;
        $user = User::create($data);
        //Token kreálás
        $token = $user->createToken('authToken')->accessToken;

        $this->sendVerificationEmail($user);


        return response()->json([
            'user' => $user,
            'accessToken' => $token,
        ]);
    }
    public function login(LoginUserRequest $request)
    {
        //Validálás
        $data = $request->validated();

        //Autentikáció
        if (Auth::attempt($data)) {
            // Authenticated user
            $user = Auth::user();

            if ($user->isVerified) {
                $token = $user->createToken('authToken')->accessToken;

                return response()->json([
                    'user' => $user,
                    'accessToken' => $token,
                ]);

            }
            else {
                Auth::logout();
                return response()->json([
                    'error' => 'Még nem erősítette meg a felhasználóját!',
                    'user' => $user,
                ], 401);
            }
        }

        //Autentikációs hiba
        return response()->json(['error' => 'Hibás bejelentkezés'], 401);

    }


    public function logout()
    {
        /*Auth::user()->token()->revoke();

        return response()->json(['message' => 'Sikeres kijelentkezés'], 200);*/

        Auth::logout();
        return response()->json(['message' => 'Sikeres kijelentkezés'], 200);
    }
    public function refresh()
    {

    }
    public function user()
    {

    }

    public function sendVerificationEmail($user)
    {
        $verificationLink = route('verify.email', ['token' => $user->verificationToken]);

        Mail::to($user->email)->send(new VerificationEmail($verificationLink));
    }
}
