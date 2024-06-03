<?php

namespace App\Http\Controllers\Api;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::all(); // Get all Kecamatan records

        if ($kecamatans->isEmpty()) {
            return response()->json([]);
        }

        $data = $kecamatans->map(function ($kecamatan) {
            return [
                'id' => $kecamatan->id,
                'name_kecamatan' => $kecamatan->name_kecamatan,
            ];
        });
        return  response()->json($data);
    }
    public function get(Request $request)
    {
        $data = Kecamatan::findOrFail($request->id);
    }
}
