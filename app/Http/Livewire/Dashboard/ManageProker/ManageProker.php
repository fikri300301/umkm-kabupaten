<?php

namespace App\Http\Livewire\Dashboard\ManageProker;

use App\Models\Proker;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ManageProker extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $limitPage = 10;
    public $search = '';
    public $page = 1;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => '']
    ];

    public $showModal = false;
    public $formAction = '';
    public $idEntity = null;

    protected $listeners = [
        'editButtonFromGlobal' => 'editManageProker',
        'deleteButtonFromGlobal' => 'deleteManageProker',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data =Proker::with(['user','division'])->when(!empty($this->search),function($query){
            return $query->where('name_proker', 'LIKE', '%' . $this->search . '%');
        })->orderBy('name_proker', 'asc')->paginate($this->limitPage);
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
        return view('dashboard.manage-proker.livewire.manage-proker',[
            'data'=>$this->getAllData(),
        ]);
    }

    public function addManageProker()
    {
        return to_route('create-proker');
    }

    public function editManageProker($slug)
    {
        return to_route('edit-proker',['slug' => $slug]);
    }

    public function deleteManageProker($idEntity)
    {
        try {
            $proker = Proker::findOrFail(decrypt($idEntity));
            $proker->delete();
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
