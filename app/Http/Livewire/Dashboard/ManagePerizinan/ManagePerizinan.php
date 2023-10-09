<?php

namespace App\Http\Livewire\Dashboard\ManagePerizinan;

use Livewire\Component;
use App\Models\Perizinan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ManagePerizinan extends Component
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

    protected $listeners = [
        'editButtonFromGlobal' => 'editManagePerizinan',
        'deleteButtonFromGlobal' => 'deleteManagePerizinan',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = Perizinan::when(!empty($this->search),function($query){
            return $query->where('name_perizinan', 'LIKE', '%' . $this->search . '%');
        })->orderBy('name_perizinan', 'asc')->paginate($this->limitPage);
        return $data;
    }

     public function resetAll()
    {
        $this->nama ='';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-perizinan.livewire.manage-perizinan',[
            'data'=>$this->getAllData(),
        ]);
    }

    public function addManagePerizinan()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahPerizinan()
    {
        $this->validate([
            'nama' =>  ['required','unique:perizinans,name_perizinan','regex:/^[\w\s-]+$/']
        ]);

        try {
            Perizinan::create([
                'name_perizinan' => $this->nama
            ]);
            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            dd($e);
            $this->resetAll();
            Log::error('error tambah ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function editManagePerizinan($idEntity)
    {
        try {
            $perizinan = Perizinan::findOrFail(decrypt($idEntity));
            $this->nama = $perizinan->name_perizinan;
            $this->idEntity = encrypt($perizinan->id);
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

    public function updatePerizinan()
    {
        $this->validate([
            'nama' => ['required','unique:perizinans,name_perizinan,'.decrypt($this->idEntity)]
        ]);

        try{
            $perizinan = Perizinan::findOrFail(decrypt($this->idEntity));
            $perizinan->update([
                'name_perizinan' => $this->nama
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

    public function deleteManagePerizinan($idEntity)
    {
        try {
            $perizinan = Perizinan::findOrFail(decrypt($idEntity));
            $perizinan->delete();
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