<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('profilePicture')) {
            $request->validate([
                'profilePicture' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $file = $request->file('profilePicture');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $url = Storage::disk('s3')->url('profile_pictures/' . $fileName);

            return response()->json(['message' => 'File successfully uploaded', 'path' => $url], 201);
        }
    }
}
