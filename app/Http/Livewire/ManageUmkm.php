<?php

namespace App\Http\Livewire;

use App\Models\umkm;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ManageUmkm extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $limitPage = 10;
    public $search = '';
    public $page = 1;

   public $produk = '';
   public $nama = '';
    public $pelatihans = [];
    public $bantuans = [];
    public $perizinans = [];
    public $category = '';
    public $bidang = '';

    public $pemilik = '';

    public $telepon = '';
    public $nik = '';
    public $alamat = '';

    public $rt = '';

    public $rw = '';

    public $desa = '';

    public $kecamatan = '';

    public $kapasitas_produk = '';

    public $omset = '';

    public $tenaga_kerja = '';
    
    public $daerah_pemasaran = '';

    public $modal_usaha = '';


    public $umkmperizinan;


    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $showModal = false;
    public $formAction = '';
    public $idEntity = null;

    protected $listeners = [
        'editButtonFromGlobal' => 'editManageUmkm',
        'deleteButtonFromGlobal' => 'deleteManageUmkm',
        'anyButtonFromGlobal' => 'showUmkm',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {

        $data = umkm::with(['desa'])->when(!empty($this->search),function($query){
            return $query->where('nama', 'LIKE', '%' . $this->search . '%');
        })->orderBy('nama', 'asc')->paginate($this->limitPage);
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
        return view('livewire.manage-umkm',[
            'data' => $this->getAllData(),
        ]);
    }

    public function addManageUmkm()
    {
       return to_route('create-umkm');
    }

    public function tambahManageUmkm()
    {
        $this->validate([

        ]);

        try {

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

    public function editManageUmkm($slug_umkm)
    {
        return redirect('/dashboard/edit-umkm/'.$slug_umkm);
    }

    public function showUmkm($slug_umkm){
        
        try {
            $umkm = umkm::with(['pelatihan','pelatihan.categories','bidang','desa','kecamatan','category','umkmperizinan'])->where('slug_umkm',$slug_umkm)->first();
           // dd($umkm);  
                $this->nama = $umkm->nama;
                $this->produk = $umkm->produk;
                $this->bidang = $umkm->bidang->name_bidang;
                $this->telepon = $umkm->telepon;
                $this->nik = $umkm->nik;
                $this->alamat = $umkm->alamat;
                $this->rt = $umkm->rt;
                $this->rw = $umkm->rw;
                $this->desa = $umkm->desa->name_desa;
                $this->kecamatan =$umkm->kecamatan->name_kecamatan;
                $this->kapasitas_produk = $umkm->kapasitas_produk;
                $this->omset = $umkm->omset;
                $this->tenaga_kerja = $umkm->tenaga_kerja;
                $this->daerah_pemasaran = $umkm->daerah_pemasaran;
                $this->modal_usaha = $umkm->modal_usaha;
                $this->category = $umkm->category->name_category;
                $this->pelatihans = $umkm->pelatihan;
                $this->bantuans = $umkm->bantuan;
                $this->perizinans = $umkm->perizinan;
                $this->dispatchBrowserEvent('openFormModal');
        } catch  (\Exception $e) {
            dd($e);
            Log::error('error edit category ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

  

    public function deleteManageUmkm($idEntity)
    {
        try {
            $umkm = umkm::findOrFail(decrypt($idEntity));
            $umkm->delete();
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