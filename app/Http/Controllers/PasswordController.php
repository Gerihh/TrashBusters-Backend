<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasswordController extends Controller

{
    public function changePassword(Request $request, User $userId)
    {
        try {
            $user = User::find($userId->id);
            $oldPassword = $request->input('oldPassword');
            $newPassword = $request->input('newPassword');
            $newPasswordAgain = $request->input('newPasswordAgain');


            $validator = Validator::make(
                ['newPassword' => $newPassword],
                [
                    'newPassword' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])/',
                ],
                [
                    'newPassword.required' => 'Jelszó megadása kötelező',
                    'newPassword.min' => 'A jelszónak legalább 8 karakterből kell állnia',
                    'newPassword.regex' => 'A jelszónak legalább egy nagybetűt és egy számot kell tartalmaznia'
                ]
            );

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 400);
            }


            if (Hash::check($oldPassword, $user->password)) {

                if ($newPassword == $newPasswordAgain) {
                    if ($newPassword != $oldPassword) {
                        $user->password = bcrypt($newPassword);
                        $user->save();

                        return response()->json(['message' => 'Jelszó sikeresen megváltoztatva!'], 200);
                    } else {
                        return response()->json(['error' => 'Az új jelszó nem egyezhet a régivel!'], 400);
                    }
                } else {
                    return response()->json(['error' => 'Az új jelszavak nem egyeznek!'], 400);
                }
            } else {
                return response()->json(['error' => 'Helytelen régi jelszó!'], 400);
            }
        } catch (\Exception $error) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $token = Str::random(32);

        if (!$user) {
            return response()->json(['error' => 'Nincs regisztrált fiók ezzel az email-lel'], 404);
        }
        $user->update(['passwordResetToken' => $token]);

        (new MailController())->sendPasswordResetEmail($user);

        return response()->json(['message' => 'Email elküldve!'], 200);
    }

    public function getUserByResetToken($token)
    {
        $user = User::where('passwordResetToken', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Nincs ilyen token'], 404);
        }

        return response()->json(['id' => $user->id], 200);
    }
}
