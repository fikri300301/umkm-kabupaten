<?php

namespace App\Http\Livewire\Partials;

use Livewire\Component;
use App\Models\Config;

class FilosofiLogo extends Component
{
    public $readyToLoad = false;
    public $imageLogo;
    public $description;
    protected $listeners = [
        'refresh' => '$refresh',
    ];
    public function loadFilosofiLogo(){
        $this->readyToLoad = true;
    }
    public function render()
    {
        if ($this->readyToLoad) {
            $data = Config::whereIn('key',['image-filosofi-logo','description-filosofi-logo'])->get();
            $this->imageLogo = $data->where('key', 'image-filosofi-logo')->first()->value;
            $this->description = $data->where('key', 'description-filosofi-logo')->first()->value;
        }
        return view('livewire.partials.filosofi-logo');
    }
}
