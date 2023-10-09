<?php


namespace App\Http\Livewire\Dashboard\ManageArticle;
use App\Models\Article;
use App\Enum\PublishOrDraft;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ManageArticle extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $limitPage = 10;
    public $search = '';
    public $page = 1;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $showModal = false;
    public $formAction = '';
    public $idEntity = null;

    protected $listeners = [
        'editButtonFromGlobal' => 'editManageArticle',
        'deleteButtonFromGlobal' => 'deleteManageArticle',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = Article::with(['user','categories'])->when(!empty($this->search),function($query){
            return $query->where('title_article', 'LIKE', '%' . $this->search . '%');
        })->orderBy('title_article', 'asc')->paginate($this->limitPage);
        return $data;
    }

     public function resetAll()
    {
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-article.livewire.manage-article',[
            'data'=>$this->getAllData()
        ]);
    }

    public function addManageArticle()
    {
     return to_route('create-article');
    }

   
    public function editManageArticle($slug)
    {
      return to_route('edit-article',['slug' => $slug]);
    }

    

    public function deleteManageArticle($idEntity)
    {
        try {
            $article = Article::findOrFail(decrypt($idEntity));
            $article->delete();
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error deleting', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }



}