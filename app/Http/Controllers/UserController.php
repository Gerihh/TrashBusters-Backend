<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Felhasználók lekérése",
     *     description="Az összes felhasználó lekérése",
     *     tags={"Felhasználók"},
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés esetén a felhasználók adatai",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="username", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="city", type="string"),
     *                 @OA\Property(property="password", type="string"),
     *                 @OA\Property(property="profilePictureURL", type="string"),
     *                 @OA\Property(property="verificationToken", type="string"),
     *                 @OA\Property(property="isVerified", type="boolean"),
     *                 @OA\Property(property="passwordResetToken", type="string"),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Felhasználó lekérése",
     *     description="Felhasználó adatainak lekérése azonosító alapján",
     *     tags={"Felhasználók"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="A felhasználó azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés esetén a felhasználó adatai",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="username", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="city", type="string"),
     *                 @OA\Property(property="password", type="string"),
     *                 @OA\Property(property="profilePictureURL", type="string"),
     *                 @OA\Property(property="verificationToken", type="string"),
     *                 @OA\Property(property="isVerified", type="boolean"),
     *                 @OA\Property(property="passwordResetToken", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nem található felhasználó az adott azonosítóval",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
    public function show($userId)
    {
        $user = User::find($userId);
        if ($user == null) {
            return response()->json(['error' => 'Nem található felhasználó az adott azonosítóval'], 404);
        } else {
            return response()->json($user);
        }
    }
    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Felhasználó frissítése",
     *     description="Felhasználó adatainak frissítése azonosító alapján",
     *     tags={"Felhasználók"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="A felhasználó azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="A frissítendő felhasználó adatai",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="password", type="string", format="password"),
     *             @OA\Property(property="profilePictureURL", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres frissítés esetén a frissített felhasználó adatai",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="username", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="city", type="string"),
     *                 @OA\Property(property="password", type="string"),
     *                 @OA\Property(property="profilePictureURL", type="string"),
     *                 @OA\Property(property="verificationToken", type="string"),
     *                 @OA\Property(property="isVerified", type="boolean"),
     *                 @OA\Property(property="passwordResetToken", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Hibás kérés esetén a validációs hibaüzenetek",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="object"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nem található felhasználó az adott azonosítóval",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     * )
     */
    public function update(Request $request, $userId)
    {
        $data = $request->all();

        $rules = [
            'username' => 'unique:users|min:6',
            'email' => 'email|unique:users',
            'password' => 'string|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])/'
        ];
        $messages = [
            'username.unique' => 'A megadott felhasználónév már foglalt',
            'username.min' => 'A felhasználónév legalább 6 karakter hosszú kell legyen',
            'email.email' => 'Érvénytelen e-mail cím',
            'email.unique' => 'A megadott e-mail cím már foglalt',
            'password.string' => 'A jelszónak karaktereket kell tartalmaznia',
            'password.min' => 'A jelszónak legalább 8 karakterből kell állnia',
            'password.regex' => 'A jelszónak legalább egy nagybetűt és egy számot kell tartalmaznia'
        ];

        $user = User::find($userId);
        if (!$user) {

            return response()->json(['message' => 'Nincs ilyen felhasználó'], 404);
        } else {
            $validator = Validator::make($data, $rules, $messages);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['error' => $errors], 400);
            } else {
                $request['password'] = bcrypt($request->password);
                $user->update($request->all());
                return response()->json($user, 200);
            }
        }
    }
    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Felhasználó törlése",
     *     description="Felhasználó törlése azonosító alapján",
     *     tags={"Felhasználók"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="A felhasználó azonosítója",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres törlés esetén a törlés visszaigazolása",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nem található felhasználó az adott azonosítóval",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
    public function destroy($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'Nincs ilyen felhasználó'], 404);
        } else {
            $user->delete();
            return response()->json(["message" => "Felhasználó törölve"], 200);
        }
    }
    /**
     * @OA\Get(
     *     path="/api/users/username/{username}",
     *     summary="Felhasználó megkeresése a felhasználónév alapján",
     *     description="Felhasználó megkeresése a felhasználónév alapján",
     *     tags={"Felhasználók"},
     *     @OA\Parameter(
     *         name="username",
     *         in="path",
     *         required=true,
     *         description="A felhasználó felhasználóneve",
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sikeres lekérés esetén a felhasználó adatai",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="username", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="city", type="string"),
     *                 @OA\Property(property="password", type="string"),
     *                 @OA\Property(property="profilePictureURL", type="string"),
     *                 @OA\Property(property="verificationToken", type="string"),
     *                 @OA\Property(property="isVerified", type="boolean"),
     *                 @OA\Property(property="passwordResetToken", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nem található felhasználó az adott felhasználónévvel",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string"),
     *         ),
     *     ),
     * )
     */
    public function getUserByUsername($username)
    {
        $user = User::where('username', $username)->first();
        if ($user == null) {

            return response()->json(['error' => 'Nincs ilyen nevű felhasználó'], 404);
        } else {
            return response()->json($user);
        }
    }

    public function verifyDeletion(Request $request)
    {
        $userId = $request->input('userId');
        $enteredCode = $request->input('enteredCode');

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'Nincs ilyen felhasználó'], 404);
        }

        $storedCode = Cache::get('deletion_code_' . $user->id);

        if ($enteredCode === $storedCode) {
            return response()->json(['message' => 'A kód helyes!'], 200);
        } else {
            return response()->json(['message' => 'A megadott kód nem megfelelő!'], 400);
        }
    }
}
