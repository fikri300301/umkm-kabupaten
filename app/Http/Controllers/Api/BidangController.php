<?php

namespace App\Http\Controllers\Api;

use App\Models\Bidang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BidangController extends Controller
{

    public function index()
    {
        $bidangs = Bidang::all(); // Get all Kecamatan records

        if ($bidangs->isEmpty()) {
            return response()->json([]);
        }

        $data = $bidangs->map(function ($bidang) {
            return [
                'id' => $bidang->id,
                'nama bidamg' => $bidang->name_bidang,
            ];
        });
        return  response()->json($data);
    }
}