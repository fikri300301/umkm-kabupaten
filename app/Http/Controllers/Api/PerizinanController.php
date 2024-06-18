<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perizinan;
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    public function index()
    {
        $perizinans = Perizinan::all();

        if ($perizinans->isEmpty()) {
            return response()->json(['data belum, tersedia ']);
        }

        $data = $perizinans->map(function ($perizinan) {
            return [
                'No' => $perizinan->id,
                'Nama perizinan' => $perizinan->name_perizinan,
            ];
        });

        return response()->json($data);
    }
}