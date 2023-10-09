<?php

namespace App\Models;

use App\Models\umkm;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Perizinan extends Model
{
    use HasFactory,Sluggable;

    protected $guarded =['id'];

    public function sluggable(): array
    {
        return [
            'slug_perizinan' => [
                'source' => 'name_perizinan'
            ]
        ];
    }

    public function umkm():BelongsToMany{
        return $this->belongsToMany(umkm::class, 'umkm_perizinans','perizinan_id','umkm_id');
    }

    public function umkmPerizinan(){
        return $this->belongsTo(UmkmPerizinan::class);
    }
}