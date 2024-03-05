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
 *          @OA\Property(property="user", type="object"),
 *          @OA\Property(property="accessToken", type="string"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Sikertelen regisztráció",
 *         @OA\JsonContent(
 *          @OA\Property(property="error", type="error.message"),
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
            'user' => $user,
            'accessToken' => $token,
        ]);
    }
    /**
 * @OA\Post(
 *     path="/api/auth/login",
 *     summary="Bejelentkezés",
 *     description="Bejelentkezés meglévő felhasználóval",
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
 *             @OA\Property(property="user", type="object"),
 *             @OA\Property(property="accessToken", type="string"),
 *         ),
 *     ),
 *      @OA\Response(
 *         response=400,
 *         description="Sikertelen bejelentkezés",
 *         @OA\JsonContent(
 *          @OA\Property(property="error", type="error.message"),
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
                    'user' => $user,
                    'accessToken' => $token,
                ]);
            } else {
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
    /**
 * @OA\Post(
 *     path="/api/auth/logout",
 *     summary="Kijelentkezés",
 *     description="Felhasználó kijelentkezése",
 *     @OA\Response(
 *         response=200,
 *         description="Sikeres kijelentkezés",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Sikertelen kijelentkezés",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string"),
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
