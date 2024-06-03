<?php

namespace App\Http\Livewire\Dashboard\ManageBantuan;

use App\Models\Bantuan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;


class ManageBantuan extends Component
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
    public $deskripsi;
    public $sumber;
    public $tahun;

    protected $listeners = [
        'editButtonFromGlobal' => 'editManageBantuan',
        'deleteButtonFromGlobal' => 'deleteManageBantuan',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = Bantuan::when(!empty($this->search),function($query){
            return $query->where('name_bantuan', 'LIKE', '%' . $this->search . '%');
        })->orderBy('name_bantuan', 'asc')->paginate($this->limitPage);
        return $data;
    }

     public function resetAll()
    {
        $this->nama = '';
        $this->deskripsi = '';
        $this->tahun = '';
        $this->sumber = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-bantuan.livewire.manage-bantuan',[
            'data'=>$this->getAllData(),
        ]);
    }

    public function addManageBantuan()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahBantuan()
    {
        $this->validate([
            'nama' => ['required','unique:bantuans,name_bantuan','regex:/^[\w\s-]+$/'],
            'deskripsi' => ['required'],
            'tahun' => ['required'],
            'sumber' => ['required']
        ]);

        try {
            Bantuan::create([
                'name_bantuan' => $this->nama,
                'tahun' => $this->tahun,
                'sumber_bantuan' => $this->sumber,
                'description_bantuan' => $this->deskripsi
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

    public function editManageBantuan($idEntity)
    {
        try {
            $bantuan = Bantuan::findOrFail(decrypt($idEntity));
            $this->nama = $bantuan->name_bantuan;
            $this->deskripsi = $bantuan->description_bantuan;
            $this->tahun = $bantuan->tahun;
            $this->sumber = $bantuan->sumber_bantuan;
            $this->idEntity = encrypt($bantuan->id);
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

    public function updateBantuan()
    {
        $this->validate([
            'nama' => ['required','unique:bantuans,name_bantuan,'.decrypt($this->idEntity)],
            'deskripsi' => ['required'],
            'tahun' => ['required'],
            'sumber' => ['required']
        ]);

        try{
            $bantuan = Bantuan::findOrFail(decrypt($this->idEntity));
            $bantuan->update([
                'name_bantuan' => $this->nama,
                'description_bantuan' => $this->deskripsi,
                'tahun' => $this->tahun,
                'sumber_bantuan' => $this->sumber
            ]);
            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        }catch (\Exception $e) {
            dd($e);
            Log::error('error update', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function deleteManageBantuan($idEntity)
    {
        try {
            $bantuan = Bantuan::findOrFail(decrypt($idEntity));
            $bantuan->delete();
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