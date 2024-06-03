<?php

namespace App\Http\Livewire\partials;

use Livewire\Component;
use App\Models\Division;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class CardDivision extends Component
{
    public $readyToLoad = false;

    public function loadDivision()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        return view('livewire.partials.card-division', [
            'data' => $this->readyToLoad ? Division::where('status_division', 'publish')->get() : [],
        ]);
    }
}
