<?php

namespace App\Models;

use App\Models\umkm;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    
    public function sluggable(): array
    {
        return [
            'slug_desa' => [
                'source' => 'name_desa'
            ]
            ];
    }

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class);
    }

    public function umkm(){
        return $this->hasMany(umkm::class, 'umkm_id');
    }
}