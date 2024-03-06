<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\NewUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
/**
 * @OA\Post(
 *     path="/api/auth/register",
 *     summary="Regisztráció",
 *     description="Új felhasználó regisztrálása",
 *     tags={"Hitelesítés"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="username", type="string", example="user"),
 *                 @OA\Property(property="email", type="string", example="user@gmail.com"),
 *                 @OA\Property(property="password", type="string", example="password"),
 *                 @OA\Property(property="city", type="string", example="Budapest"),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Sikeres regisztráció",
 *         @OA\JsonContent(
 *             @OA\Property(property="user", type="object",
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="username", type="string"),
 *                 @OA\Property(property="email", type="string"),
 *                 @OA\Property(property="city", type="string"),
 *                 @OA\Property(property="isVerified", type="boolean"),
 *                 @OA\Property(property="profilePictureURL", type="string"),
 *             ),
 *             @OA\Property(property="accessToken", type="string"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Sikertelen regisztráció",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Hibás regisztráció",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="username", type="array", @OA\Items(type="string")),
 *                 @OA\Property(property="email", type="array", @OA\Items(type="string")),
 *                 @OA\Property(property="password", type="array", @OA\Items(type="string")),
 *             ),
 *         ),
 *     ),
 * )
 */
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

        //$this->sendVerificationEmail($user);
        (new MailController)->sendVerificationEmail($user);

        return response()->json([
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'city' => $user->city,
                'isVerified' => $user->isVerified,
                'profilePictureURL' => $user->profilePictureURL,
            ],
            'accessToken' => $token,
        ], 200);

        if (!$user) {
            return response()->json([
                'error' => 'Sikertelen regisztráció'
            ], 400);
        }
    }
 /**
 * @OA\Post(
 *     path="/api/auth/login",
 *     summary="Bejelentkezés",
 *     description="Bejelentkezés meglévő felhasználóval",
 *     tags={"Hitelesítés"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="email", type="string", example="user@gmail.com"),
 *                 @OA\Property(property="password", type="string", example="password"),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Sikeres bejelentkezés",
 *         @OA\JsonContent(
 *             @OA\Property(property="user", type="object",
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="username", type="string"),
 *                 @OA\Property(property="email", type="string"),
 *                 @OA\Property(property="city", type="string"),
 *                 @OA\Property(property="isVerified", type="integer"),
 *                 @OA\Property(property="profilePictureURL", type="string"),
 *             ),
 *             @OA\Property(property="accessToken", type="string"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Megerősítetlen felhasználó",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string"),
 *             @OA\Property(property="user", type="object",
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="username", type="string"),
 *                 @OA\Property(property="email", type="string"),
 *                 @OA\Property(property="city", type="string"),
 *                 @OA\Property(property="isVerified", type="integer"),
 *                 @OA\Property(property="profilePictureURL", type="string"),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Sikertelen bejelentkezés",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string"),
 *         ),
 *     ),
 * )
 */
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
                    'user' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'city' => $user->city,
                        'isVerified' => $user->isVerified,
                        'profilePictureURL' => $user->profilePictureURL,
                    ],
                    'accessToken' => $token,
                ], 200);
            } else {
                Auth::logout();
                return response()->json([
                    'error' => 'Még nem erősítette meg a felhasználóját!',
                    'user' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'city' => $user->city,
                        'isVerified' => $user->isVerified,
                        'profilePictureURL' => $user->profilePictureURL,
                    ],
                ], 401);
            }
        }

        //Autentikációs hiba
        return response()->json(['error' => 'Hibás bejelentkezés'], 400);
    }
    /**
 * @OA\Post(
 *     path="/api/auth/logout",
 *     summary="Kijelentkezés",
 *     description="Felhasználó kijelentkezése",
 *     tags={"Hitelesítés"},
 *     @OA\Response(
 *         response=200,
 *         description="Sikeres kijelentkezés",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *         ),
 *     ),
 * )
 */

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Sikeres kijelentkezés'], 200);
    }
}
