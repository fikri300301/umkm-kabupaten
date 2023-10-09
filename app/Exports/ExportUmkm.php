<?php

namespace App\Exports;

use App\Models\umkm;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportUmkm implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
       $data = umkm::with(['desa','bidang','category','kecamatan'])->orderBy('nama', 'desc')->get();
      return view('livewire.table-umkm',['data'=>$data]);
    }
}