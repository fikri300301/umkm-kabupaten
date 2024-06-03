<?php

namespace App\Http\Livewire\Dashboard\ManageDesa;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pelatihan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ManageDesa extends Component
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

    public $kecamatan;

    protected $listeners = [
        'editButtonFromGlobal' => 'editManageDesa',
        'deleteButtonFromGlobal' => 'deleteManageDesa',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = Desa::with(['kecamatan'])->when(!empty($this->search),function($query){
            return $query->where('name_desa','LIKE','%'.$this->search.'%');
        })->orderBy('name_desa','asc')->paginate($this->limitPage);
        return $data;

    }

     public function resetAll()
    {
        $this->nama = '';
        $this->kecamatan = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-desa.livewire.manage-desa',[
            'data'=>$this->getAllData(),
            'kecamatans' => Kecamatan::all()
        ]);
    }

    public function addManageDesa()
    {

        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahDesa()
    {
        $this->validate([
            'nama' => ['required','unique:desas,name_desa','regex:/^[\w\s-]+$/'],
            'kecamatan' => ['required']
        ]);

        try {
            Desa::create([
                'name_desa' => $this->nama,
                'kecamatan_id' => $this->kecamatan
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

    public function editManageDesa($idEntity)
    {
        try {
            $desa = Desa::findOrFail(decrypt($idEntity));
            $this->nama = $desa->name_desa;
            $this->kecamatan = $desa->kecamatan_id;
            $this->idEntity = encrypt($desa->id);
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

    public function updateDesa()
    {
        $this->validate([
            'nama' => ['required','unique:desas,name_desa,'.decrypt($this->idEntity)],
            'kecamatan' => ['required']
        ]);

        try{
            $desa = Desa::findOrFail(decrypt($this->idEntity));
            $desa->update([
                'name_desa' => $this->nama,
                'kecamatan_id' => $this->kecamatan
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

    public function deleteManageDesa($idEntity)
    {
        try {
            $desa = Desa::findOrFail(decrypt($idEntity));
            $desa->delete();
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