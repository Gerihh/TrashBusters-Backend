<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\NewUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(NewUserRequest $request)
    {
        //Validálás

        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        //Token kreálás
        $token = $user->createToken('authToken')->accessToken;


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

            //Token
            $token = $user->createToken('authToken')->accessToken;

            return response()->json([
                'user' => $user,
                'accessToken' => $token,
            ]);
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
}
