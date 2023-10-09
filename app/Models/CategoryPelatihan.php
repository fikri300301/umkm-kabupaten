<?php

namespace App\Models;

use App\Models\Pelatihan;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryPelatihan extends Model
{
    use HasFactory,Sluggable;

    protected $guarded = ['id'];

    protected $table = 'category_pelatihans';

    public function sluggable(): array
    {
       return  [
            'slug_category' => [
                'source' => 'name_category'
            ]
        ];
    }

    public function pelatihans(){
        return $this->hasMany(Pelatihan::class, 'pelatihan_id');
    }
}