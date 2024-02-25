<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
{
    public function upload(Request $request, User $userId)
{
    $request->validate([
        'profilePicture' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
    ]);

    if ($request->hasFile('profilePicture')) {
        $file = $request->file('profilePicture');
        $filename = time() . '_' . $file->getClientOriginalName();


        $file->storePubliclyAs('', $filename, 's3');


        $url = Storage::disk('s3')->url($filename);

        User::where('id', $userId->id)->update(['profilePictureURL' => $url]);

        return response()->json(['message' => 'File uploaded successfully', 'url' => $url], 200);
    } else {
        return response()->json(['message' => 'No file was uploaded'], 400);
    }
}
}
