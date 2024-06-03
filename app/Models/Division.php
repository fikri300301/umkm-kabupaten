<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;

class Division extends Model implements Viewable
{
    use InteractsWithViews;
    use Sluggable;

    protected $guarded =['id'];

    public function sluggable(): array
    {
        return [
            'slug_division' => [
                'source' => 'name_division'
            ]
        ];
    }

    public function proker(){
        return $this->hasMany(Proker::class, 'division_id','id');
    }

    
   
}