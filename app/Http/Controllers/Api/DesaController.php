<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        $desas = Desa::all(); // Get all Kecamatan records

        if ($desas->isEmpty()) {
            return response()->json([]);
        }

        $data = $desas->map(function ($desa) {
            return [
                'id' => $desa->id,
                'name_desa' => $desa->name_desa,
            ];
        });
        return  response()->json($data);
    }
}