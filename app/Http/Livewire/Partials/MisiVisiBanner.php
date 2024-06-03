<?php

namespace App\Http\Livewire\Partials;

use App\Models\Config;
use Livewire\Component;

class MisiVisiBanner extends Component
{
    public $readyToLoad = false;
    public $misi;
    public $visi;
    public $banner;

    protected $listeners = [
        'refresh' => '$refresh',
    ];
    public function loadVisiMisiBanner()
    {
        $this->readyToLoad = true;
    }
    public function render()
    {
        if ($this->readyToLoad) {
            $data = Config::whereIn('key',['misi','visi','banner'])->get();
            $this->misi = $data->where('key', 'misi')->first()->value;
            $this->visi = $data->where('key', 'visi')->first()->value;
            $this->banner = $data->where('key', 'banner')->first()->value;
        }
        return view('livewire.partials.misi-visi-banner');
    }
}
