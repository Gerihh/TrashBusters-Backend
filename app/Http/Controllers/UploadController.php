<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads', $imageName, 'public');

                $imageUrl = '/uploads/' . $imageName;

                return response()->json(['imageUrl' => $imageUrl], 200);
            } else {
                return response()->json(['message' => 'No file provided.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error uploading image.', 'error' => $e->getMessage()], 500);
        }
    }
}
