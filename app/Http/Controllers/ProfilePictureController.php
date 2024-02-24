<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'profilePicture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profilePicture')) {
            $image = $request->file('profilePicture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            Storage::put($imageName, $image);

            $path = Storage::url($imageName);

            return response()->json(['message' => 'File uploaded successfully', 'path' => $path], 200);
        } else {
            return response()->json(['message' => 'No file was uploaded'], 400);
        }
    }
}
