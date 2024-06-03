<?php

namespace App\Http\Livewire\Dashboard\PenerimaBantuan;

use App\Models\umkm;
use App\Models\Bantuan;
use App\Models\UmkmBantuan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class PenerimaBantuan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $limitPage = 10;
    public $search = '';
    public $page = 1;

    protected $queryString = [
        'search' => ['except' => ''],
    ];
    public $readyToLoad = false;
    public $nama = '';
    
    public $umkm_id = '';
    
    public $bantuan_id ='';
    public $bantuanId = '';

    public $showModal = false;
    public $formAction = '';
    public $idEntity = null;

    protected $listeners = [
        'editButtonFromGlobal' => 'editPenerimaBantuan',
        'deleteButtonFromGlobal' => 'deletePenerimaBantuan',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data1 = umkm::when(!empty($this->search),function($query){
            return $query->where('nama', 'LIKE', '%' . $this->search . '%');
        })->orderBy('nama', 'asc')->paginate($this->limitPage);
        return $data1;
    }

    public function ons()
    {
      $this->readyToLoad = true;  
    }

     public function resetAll()
    {
        $this->umkm_id = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        $bantuan = Bantuan::with('umkm')->where('id', $this->bantuanId)->first();
        $umkm = $this->readyToLoad ? $bantuan->umkm : [];
        $this->nama = $bantuan->name_bantuan;
        return view('dashboard.penerima-bantuan.livewire.penerima-bantuan',[
            'data' => $umkm,
            
            'umkms' => umkm::all(),
            'data1' => $this->getAllData()
        ]);
    }

    public function addPenerimaBantuan()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahPenerimaBantuan()
    {
        $this->validate([
            'umkm_id' => 'required'
        ]);
        $umkm = UmkmBantuan::where('umkm_id',$this->umkm_id)->where('bantuan_id',$this->bantuanId )->first();
        if(!is_null($umkm)){
            return $this->dispatchBrowserEvent('errorSuccess',['message' => 'umkm sudah pernah mengikuti pelatihan ini']);
        }
        try {

            UmkmBantuan::create([
                'umkm_id' => $this->umkm_id,
                'bantuan_id' => $this->bantuanId
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

   


    public function deletePenerimaBantuan($id)
    {
        try {
            $penerima = UmkmBantuan::where('umkm_id',decrypt($id))->where('bantuan_id',$this->bantuanId)->first();
            $penerima->delete();
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            dd($e);
            Log::error('error deleting', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }



}