<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proker extends Model
{
    use HasFactory,Sluggable;

    protected $guarded =['id'];

    public function sluggable(): array
    {
        return [
            'slug_proker' => [
                'source' => 'name_proker'
            ]
            ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function division(){
        return $this->belongsTo(Division::class);
}
}