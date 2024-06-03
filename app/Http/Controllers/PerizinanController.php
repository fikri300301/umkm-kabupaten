<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Perizinan;
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    public function index(){
        return view('dashboard.manage-perizinan.perizinan');
    }

    public function list($slug_perizinan){
        // cek pelatihan dengan slug iki enek ga
        $perizinan = Perizinan::where('slug_perizinan', $slug_perizinan)->first();
  
        if(is_null($perizinan)){
            //tidak ada return 404
            abort(404);
        }
        // ada return view
        return view('dashboard.penerima-perizinan.penerima',[
           //kirim pelatihan id
            'perizinan' => $perizinan->id,
        ]
                   
    );
    }
}