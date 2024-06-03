<?php

namespace App\Http\Livewire\Dashboard\PenerimaPerizinan;

use App\Models\Perizinan;
use App\Models\umkm;
use App\Models\UmkmPerizinan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class PenerimaPerizinan extends Component
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
    public $no_perizinan = '';
    
    public $perizinan_id ='';
    public $perizinanId = '';

    public $showModal = false;
    public $formAction = '';
    public $idEntity = null;

    public $name_perizinan;

    protected $listeners = [
        'editButtonFromGlobal' => 'editPenerimaPerizinan',
        'deleteButtonFromGlobal' => 'deletePenerimaPerizinan',
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
        $this->no_perizinan = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        $perizinan = Perizinan::with('umkm')->where('id', $this->perizinanId)->first();
        $perizinan = $this->readyToLoad ? $perizinan->umkm : [];
        //$this->nama = $perizinan->name_perizinan;
        return view('dashboard.penerima-perizinan.livewire.penerima-perizinan',[
            'data' => $perizinan,
            'umkms' => umkm::all(),
            'data1' => $this->getAllData()
        ]);
    }

    public function addPenerimaPerizinan()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahPenerimaPerizinan()
    {
        $this->validate([ 
            'umkm_id' => 'required',
          
        ]);

        try {
            UmkmPerizinan::create([
                'umkm_id' => $this->umkm_id,
                'perizinan_id' => $this->perizinanId,
                // 'no_perizinan' => $this->no_perizinan
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

    public function editPenerimaPerizinan($idEntity)
    {
        try {
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

   

    public function deletePenerimaPerizinan($id)
    {
        try {
            $perizinan = UmkmPerizinan::where('umkm_id',decrypt($id))->where('perizinan_id',$this->perizinanId)->first();
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