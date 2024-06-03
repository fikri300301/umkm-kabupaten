<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $imgPath = $request->file('file')->store('media', 'public');
        return response()->json(['location' => config('app.url').'/storage/' . $imgPath]);
    }
}
