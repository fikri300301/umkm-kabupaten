<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index(){
        return view('dashboard.manage-pelatihan.pelatihan');
    }

    public function list($slug_pelatihan){
        // cek pelatihan dengan slug iki enek ga
        $pelatihan = Pelatihan::where('slug_pelatihan', $slug_pelatihan)->first();
            
        if(is_null($pelatihan)){
            //tidak ada return 404
            abort(404);
        }
        // ada return view
        return view('dashboard.peserta-pelatihan.peserta',[
           //kirim pelatihan id
            'pelatihan' => $pelatihan->id,
        ]
                   
    );
    }
}