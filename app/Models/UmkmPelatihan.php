<?php

namespace App\Models;

use App\Models\umkm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UmkmPelatihan extends Model
{
    protected $table = 'umkm_pelatihans';

    protected $guarded = ['id'];
    public function umkm(){
        return $this->belongsTo(umkm::class);
    }
    public function pelatihan(){
        return $this->belongsTo(pelatihan::class);
    }
}