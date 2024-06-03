<?php

namespace App\Models;


use App\Models\umkm;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    protected $guarded =['id'];

    public function sluggable(): array
    {
        return [
            'slug_category' => [
                'source' => 'name_category'
            ]
        ];
    }

    // public function article(){
    //     return $this->hasMany(Article::class, 'categories_id');
    // }
    public function umkm(){
        return $this->hasMany(umkm::class, 'umkm_id');
    }
    
}