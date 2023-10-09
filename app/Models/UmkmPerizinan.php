<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmPerizinan extends Model
{
    use HasFactory;

    protected $table = 'umkm_perizinans';

    protected $guarded = ['id'];
    public function umkm(){
        return $this->belongsTo(umkm::class);
    }
    public function pelatihan(){
        return $this->belongsTo(pelatihan::class);
    }
}