<?php

namespace App\Http\Livewire\Partials;

use Livewire\Component;
use App\Models\Article;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class ListArticle extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 5;
    protected $allLoaded = false;
    public $readyToLoad = false;
    public $author, $categories;
    protected $queryString = ['author', 'categories'];

    public function loadArticle()
    {
        $this->readyToLoad = true;
    }

    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function render()
    {
        $articles = $this->readyToLoad ? Article::with('categories', 'user')
            ->whereHas('categories', function ($query) {
                return $query->where('status_category', 'publish');
            })
            ->when(!is_null($this->author),function($query){
                $query->whereHas('user',function ($querys){
                    $querys->where('name', 'LIKE',  '%'.$this->author.'%');
                });
            })
            ->when(!is_null($this->categories),function($query){
                $query->whereHas('categories',function($querys){
                    $querys->where('name_category', 'LIKE', '%'.$this->categories.'%');
                });
            })
            ->where('status_article', 'publish')
            ->orderBy('created_at', 'ASC')
            ->paginate($this->perPage)
            : new LengthAwarePaginator([], 0, $this->perPage);

        if ($articles->count() === $articles->total()) {
            $this->allLoaded = true;
        }

        return view('livewire.partials.list-article', [
            'data' => $articles,
            'allLoaded' => $this->allLoaded
        ]);
    }
}
