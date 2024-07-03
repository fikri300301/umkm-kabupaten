<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = umkm::with('bidang')->get();

        if ($umkms->isEmpty()) {
            return response()->json(['data belum tersedia']);
        }

        $data = $umkms->map(function ($umkm) {
            return [
                'nama' => $umkm->nama,
                'Pemilik' => $umkm->pemilik,
                'Bidang' => $umkm->bidang->name_bidang,
                'produk' => $umkm->produk
            ];
        });

        return response()->json($data);
    }
}