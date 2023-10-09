<?php

namespace App\Http\Livewire\Partials;

use Livewire\Component;
use App\Models\Proker;

class CardProker extends Component
{
    public $readyToLoad = false;

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }

    
    public function render()
    {
        return view('livewire.partials.card-proker', [
            'data' => $this->readyToLoad
                ? Proker::with('division', 'user')
                    ->whereHas('division', function ($query) {
                        return $query->where('status_proker', 'publish');
                    })
                    ->where('status_proker', 'publish')
                    ->orderBy('created_at', 'ASC')
                    ->limit(3)->get()
                : [],
        ]);
    }
}