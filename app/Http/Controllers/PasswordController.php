<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function changePassword(Request $request, User $userId)
    {
        try {
            $user = User::find($userId->id);
            $oldPassword = $request->input('oldpassword');
            $newPassword = $request->input('newpassword');

            // Check if the old password matches the stored hashed password
            if (Hash::check($oldPassword, $user->password)) {
                // Old password matches, proceed with changing the password
                $user->password = bcrypt($newPassword);
                $user->save();

                return response()->json(['message' => 'Password changed successfully']);
            } else {
                // Old password does not match
                return response()->json(['error' => 'Incorrect old password'], 400);
            }
        } catch (\Exception $error) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
