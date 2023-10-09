<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BantuanController extends Controller
{
    public function index(){
        return view('dashboard.manage-bantuan.bantuan');
    }

    public function list($slug_bantuan){
        // cek pelatihan dengan slug iki enek ga
        $bantuan = Bantuan::where('slug_bantuan', $slug_bantuan)->first();
       
        if(is_null($bantuan)){
            //tidak ada return 404
            abort(404);
        }
        // ada return view
        return view('dashboard.penerima-bantuan.penerima',[
           //kirim pelatihan id
            'bantuan' => $bantuan->id,
        ]
                   
    );
    }
}