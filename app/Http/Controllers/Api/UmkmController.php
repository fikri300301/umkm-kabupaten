<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = umkm::all();

        if ($umkms->isEmpty()) {
            return response()->json(['data belum tersedia']);
        }

        $data = $umkms->map(function ($umkm) {
            return [
                'nama' => $umkm->nama,
                'Pemilik' => $umkm->pemilik,
                'Bidang' => $umkm->bidang_id
            ];
        });

        return response()->json($data);
    }
}