<?php

namespace App\Models;

use App\Models\umkm;
use App\Models\CategoryPelatihan;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pelatihan extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug_pelatihan' => [
                'source' => 'name_pelatihan'
            ]
        ];
    }

    public function categories(){
        return $this->belongsTo(CategoryPelatihan::class,'category_id','id');
    }

    // public function umkm(){
    //     return $this->hasMany(umkm::class, 'umkm_id');
    // }

    public function umkm():BelongsToMany{
        return $this->belongsToMany(umkm::class, 'umkm_pelatihans','pelatihan_id','umkm_id');
    }
}