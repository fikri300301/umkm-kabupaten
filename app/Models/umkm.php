<?php

namespace App\Models;

use App\Models\Bidang;
use App\Models\Category;
use App\Models\Kecamatan;
use App\Models\UmkmPerizinan;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class umkm extends Model
{
    use HasFactory,Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug_umkm' => [
                'source' => 'nama'
            ]
        ];
    }

    public function bidang(){
        return $this->belongsTo(Bidang::class);
    }

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class);
    }
    
    public function desa(){
        return $this->belongsTo(Desa::class);
    }

    public function category(){
        return $this->belongsTo(Category::class,'categories_id');
    }

    // public function perizinan(){
    //     return $this->belongsTo(Perizinan::class);
    // }

    public function bantuan():BelongsToMany{
        return $this->belongsToMany(Bantuan::class,'umkm_bantuans','umkm_id','bantuan_id');
    }

    public function pelatihan():BelongsToMany{
        return $this->belongsToMany(Pelatihan::class, 'umkm_pelatihans','umkm_id','pelatihan_id');
    }
    public function perizinan():BelongsToMany{
        return $this->belongsToMany(Perizinan::class, 'umkm_perizinans','umkm_id','perizinan_id');
    }

    // public function umkmperizinan(){
    //     return $this->belongsTo(UmkmPerizinan::class,'umkmperizinan_id');
    // }

    public function umkmperizinan():BelongsToMany{
        return $this->belongsToMany(Perizinan::class, 'umkm_perizinans','umkm_id','perizinan_id');
    }

    

}