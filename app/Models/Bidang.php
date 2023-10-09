<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug_bidang' => [
                'source' => 'name_bidang'
            ]
        ];
    }

    public function umkm(){
        return $this->hasMany(umkm::class, 'umkm_id');
    }
}