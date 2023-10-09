<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bantuan extends Model
{
    use HasFactory,Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return  [
            'slug_bantuan' => [
                'source' => 'name_bantuan'
            ]
            ];
    }

    // public function umkm(){
    //     return $this->hasMany(umkm::class, 'umkm_id');
    // }

    public function umkm():BelongsToMany{
        return $this->belongsToMany(umkm::class, 'umkm_bantuans','bantuan_id','umkm_id');
    }
}