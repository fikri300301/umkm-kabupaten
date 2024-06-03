<?php

namespace App\Http\Livewire\Dashboard\PesertaPelatihan;

use App\Models\umkm;
use Livewire\Component;
use App\Models\Pelatihan;
use Livewire\WithPagination;
use App\Models\UmkmPelatihan;
use Illuminate\Support\Facades\Log;


class PesertaPelatihan extends Component
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
   
   
    public $pelatihan_id='';
    public $pelatihanId = '';
   
    protected $listeners = [
        'editButtonFromGlobal' => 'editPesertaPelatihan',
        'deleteButtonFromGlobal' => 'deletePesertaPelatihan',
        'refresh' => '$refresh',
    ];

    public $formAction = '';

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
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        $pelatihan = Pelatihan::with('umkm')->where('id', $this->pelatihanId)->first();
        $umkm = $this->readyToLoad ? $pelatihan->umkm : [];
        $this->nama = $pelatihan->name_pelatihan;
        return view('dashboard.peserta-pelatihan.livewire.peserta-pelatihan',[
            'data' => $umkm,
            
            'umkms' => umkm::all(),
            'data1' => $this->getAllData()
        ]);
    }

    public function addPesertaPelatihan()
    {
        $this->formAction='tambah';
        $this->dispatchBrowserEvent('openFormModal');
        
    }

    public function tambahPesertaPelatihan()
    {
        $this->validate([
            'umkm_id' => 'required'
        ]);
        $umkm = UmkmPelatihan::where('umkm_id',$this->umkm_id)->where('pelatihan_id',$this->pelatihanId )->first();
            if(!is_null($umkm)){
                return $this->dispatchBrowserEvent('errorSuccess',['message' => 'umkm sudah pernah mengikuti pelatihan ini']);
            }
        try {

            UmkmPelatihan::create([
                'umkm_id' => $this->umkm_id,
                'pelatihan_id' => $this->pelatihanId
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

    

   

    public function deletePesertaPelatihan($id)
    { 
        try {
            $peserta = UmkmPelatihan::where('umkm_id',decrypt($id))->where('pelatihan_id',$this->pelatihanId)->first();
            $peserta->delete();
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