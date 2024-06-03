<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihans = Pelatihan::all();

        if ($pelatihans->isEmpty()) {
            return response()->json(['data belu, tersedia ']);
        }

        $data = $pelatihans->map(function ($pelatihan) {
            return [
                'No' => $pelatihan->id,
                'Nama pelatihan' => $pelatihan->name_pelatihan,
                'Tanggal mulai' => $pelatihan->start_date,
                'Tanggal selesai ' => $pelatihan->end_date,
                'Deskripsi pelatihan' => $pelatihan->description_pelatihan
            ];
        });

        return response()->json($data);
    }
}