<?php

namespace App\Http\Controllers\Api;

use App\Models\umkm;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function mikro()
    {
        $umkms = umkm::where('categories_id', 1)->get();

        if ($umkms->isEmpty()) {
            return response()->json(['data belum tersedia']);
        }

        $data = $umkms->map(function ($umkm) {
            return [
                'Nama' => $umkm->nama,
                'Pemilik' => $umkm->pemilik
            ];
        });

        return response()->json($data);
    }

    public function menengah()
    {
        $umkms = umkm::where('categories_id', 2)->get();

        if ($umkms->isEmpty()) {
            return response()->json(['data belum tersedia']);
        }

        $data = $umkms->map(function ($umkm) {
            return [
                'Nama' => $umkm->nama,
                'Pemilik' => $umkm->pemilik
            ];
        });

        return response()->json($data);
    }
}