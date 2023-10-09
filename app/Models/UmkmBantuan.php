<?php

namespace App\Models;

use App\Models\umkm;
use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UmkmBantuan extends Model
{
    use HasFactory;

    protected $table = 'umkm_bantuans';

    protected $guarded = ['id'];
    public function umkm(){
        return $this->belongsTo(umkm::class,'umkm_id');
    }
    public function bantuan(){
        return $this->belongsTo(Bantuan::class,'bantuan_id');
    }
}