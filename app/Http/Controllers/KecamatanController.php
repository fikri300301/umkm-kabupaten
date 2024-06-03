<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.manage-kecamatan.kecamatan');
    }

    public function api()
    {
        $data = Kecamatan::all()->except(['created_at', 'updated_at']);
        return response()->json(['data' => $data]);
    }
}
