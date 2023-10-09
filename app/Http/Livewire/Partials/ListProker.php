<?php

namespace App\Http\Livewire\Partials;

use App\Models\Proker;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class ListProker extends Component
{
    use WithPagination;
    public $perPage = 5;
    protected $allLoaded = false;
    public $readyToLoad = false;
    public $author, $division;
    protected $queryString = ['author', 'division'];
    public function loadPosts()
    {
        $this->readyToLoad = true;
    }
    public function loadMore()
    {
        $this->perPage += 5;
    }
    public function render()
    {
        $proker = $this->readyToLoad
            ? Proker::with('division', 'user')
                ->whereHas('division', function ($query) {
                    return $query->where('status_division', 'publish');
                })
                ->when(!is_null($this->author), function ($query) {
                    $query->whereHas('user', function ($querys) {
                        $querys->where('name', 'LIKE', '%' . $this->author . '%');
                    });
                })
                ->when(!is_null($this->division), function ($query) {
                    $query->whereHas('division', function ($querys) {
                        $querys->where('name_division', 'LIKE', '%' . $this->division . '%');
                    });
                })
                ->where('status_proker', 'publish')
                ->orderBy('created_at', 'ASC')
                ->paginate($this->perPage)
            : new LengthAwarePaginator([], 0, $this->perPage);

        if ($proker->count() === $proker->total()) {
            $this->allLoaded = true;
        }

        return view('livewire.partials.list-proker', [
            'data' => $proker,
            'allLoaded' => $this->allLoaded,
        ]);
    }
}
