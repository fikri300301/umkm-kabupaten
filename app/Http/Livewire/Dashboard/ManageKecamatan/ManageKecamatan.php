<?php

namespace App\Http\Livewire\Dashboard\ManageKecamatan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Log;

class ManageKecamatan extends Component
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

    protected $listeners = [
        'editButtonFromGlobal' => 'editManageKecamatan',
        'deleteButtonFromGlobal' => 'deleteManageKecamatan',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = Kecamatan::when(!empty($this->search),function($query){
            return $query->where('name_kecamatan', 'LIKE', '%' . $this->search . '%');
        })->orderBy('name_kecamatan', 'asc')->paginate($this->limitPage);
        return $data;
    }

     public function resetAll()
    {
        $this->nama = '';
      
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-kecamatan.livewire.manage-kecamatan',[
            'data'=>$this->getAllData(),
        ]);
    }

    public function addManageKecamatan()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahKecamatan()
    {
        $this->validate([
            'nama' => ['required','unique:kecamatans,name_kecamatan','regex:/^[\w\s-]+$/'],
       
        ]);

        try {
            Kecamatan::create([
                'name_kecamatan' => $this->nama,
                
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

    public function editManageKecamatan($idEntity)
    {
        try {
            $kecamatan = Kecamatan::findOrFail(decrypt($idEntity));
            $this->nama = $kecamatan->name_kecamatan;
            
            $this->idEntity = encrypt($kecamatan->id);
            $this->showModal = true;
            $this->formAction = "update";
            $this->dispatchBrowserEvent('openFormModal');
        }catch (\Exception $e) {
            Log::error('error edit kecamatan', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function updateKecamatan()
    {
        $this->validate([
            'nama' =>['required','unique:kecamatans,name_kecamatan,'.decrypt($this->idEntity)],
            
        ]);

        try{
            $kecamatan = Kecamatan::findOrFail(decrypt($this->idEntity));
            $kecamatan->update([
                'name_kecamatan' => $this->nama,
                
                
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

    public function deleteManageKecamatan($idEntity)
    {
        try {
            $kecamatan = Kecamatan::findOrFail(decrypt($idEntity));
            $kecamatan->delete();
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