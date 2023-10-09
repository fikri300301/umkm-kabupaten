<?php

namespace App\Http\Livewire\Partials;

use App\Models\Article;
use Livewire\Component;

class CardArtikel extends Component
{
    public $readyToLoad = false;

    public function loadArticle()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        return view('livewire.partials.card-artikel', [
            'data' => $this->readyToLoad
                ? Article::with('categories', 'user')
                    ->whereHas('categories', function ($query) {
                        return $query->where('status_category', 'publish');
                    })
                    ->where('status_article', 'publish')
                    ->orderBy('created_at', 'ASC')
                    ->limit(3)->get()
                : [],
        ]);
    }
}
