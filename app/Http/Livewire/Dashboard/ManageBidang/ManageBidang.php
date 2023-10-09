<?php

namespace App\Http\Livewire\Dashboard\ManageBidang;

use App\Models\Bidang;
use App\Enum\PublishOrDraft;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ManageBidang extends Component
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

    public $nama;

    public $kode;
    public $status;

     public $status_bidang = [];

    protected $listeners = [
        'editButtonFromGlobal' => 'editManageBidang',
        'deleteButtonFromGlobal' => 'deleteManageBidang',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        
        $data = Bidang::when(!empty($this->search),function($query){
            return $query->where('name_bidang', 'LIKE', '%' . $this->search . '%');
        })->orderBy('name_bidang', 'asc')->paginate($this->limitPage);
        return $data;
    }

     public function resetAll()
    {
        $this->nama = '';
        $this->status = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function mount(){
        $this->status_bidang = PublishOrDraft::cases();
    }

    public function render()
    {
        return view('dashboard.manage-bidang.livewire.manage-bidang',[
            'data'=>$this->getAllData(),
        ]);
    }

    public function addManageBidang()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahBidang()
    {
        $this->validate([
            'nama' => ['required','unique:bidangs,name_bidang','regex:/^[\w\s-]+$/'],
            'status' => ['required']
        ]);

        try {
            Bidang::create([
                'name_bidang' => $this->nama,
                'status_bidang' => $this->status
            ]);

            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            $this->resetAll();
            Log::error('error tambah ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function editManageBidang($idEntity)
    {
        try {
           $bidang = Bidang::findOrFail(decrypt($idEntity));
            $this->nama = $bidang->name_bidang;
            $this->status = $bidang->status_bidang;
            $this->idEntity = encrypt($bidang->id);
            $this->showModal = true;
            $this->formAction = "update";
            $this->dispatchBrowserEvent('openFormModal');
        }catch (\Exception $e) {
            Log::error('error edit ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function updateBidang()
    {
        $this->validate([
            'nama' => ['required','unique:bidangs,name_bidang,'.decrypt($this->idEntity)],
            'status' => ['required']
        ]);

        try{
            $bidang = Bidang::findOrFail(decrypt($this->idEntity));
            $bidang->update([
                'name_bidang' => $this->nama,
                'status_bidang' => $this->status
            ]);
            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        }catch (\Exception $e) {
            Log::error('error update', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function deleteManageBidang($idEntity)
    {
        try {
            $bidang = Bidang::findOrFail(decrypt($idEntity));
            $bidang->delete();
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