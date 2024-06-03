<?php

namespace App\Models;

use App\Models\umkm;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded=['id'];

    public function sluggable(): array
    {
        return [
            'slug_kecamatan' => [
                'source' => 'name_kecamatan'
            ]
        ];
    }

    public function desa(){
        return $this->hasMany(Desa::class,'desa_id');
    }

    public function umkm(){
        return $this->hasMany(umkm::class,'umkm_id');
    }
}