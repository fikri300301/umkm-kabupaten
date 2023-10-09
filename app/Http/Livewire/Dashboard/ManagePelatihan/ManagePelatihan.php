<?php

namespace App\Http\Livewire\Dashboard\ManagePelatihan;

use App\Models\CategoryPelatihan;
use App\Models\Pelatihan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ManagePelatihan extends Component
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
  
    public $category;
    public  $deskripsi;
    public  $start;
    public $end;

    public $tahun;

    

    protected $listeners = [
        'editButtonFromGlobal' => 'editManagePelatihan',
        'deleteButtonFromGlobal' => 'deleteManagePelatihan',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = Pelatihan::with(['categories'])->when(!empty($this->search),function($query){
            return $query->where('name_pelatihan','LIKE','%'.$this->search.'%');
        })->orderBy('name_pelatihan','asc')->paginate($this->limitPage);
        return $data;

    }

     public function resetAll()
    {
        $this->nama = '';
        $this->category = '';
        $this->deskripsi = '';
        $this->start = '';
        $this->end = '';
        $this->tahun = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-pelatihan.livewire.manage-pelatihan',[
            'data'=>$this->getAllData(),
            'categories'=>CategoryPelatihan::all()
        ]);
    }

    public function addManagePelatihan()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahPelatihan()
    {
        $this->validate([
         'nama' => ['required','unique:pelatihans,name_pelatihan','regex:/^[\w\s-]+$/'],
         'category' => ['required'],
         'start' => ['required'],
         'end' => ['required'],
         'deskripsi' => ['required'],
         'tahun' => ['required']
        ]);

        try {
            Pelatihan::create([
                'name_pelatihan' => $this->nama,
                'description_pelatihan' => $this->deskripsi,
                'category_id' => $this->category,
                'start_date' => $this->start,
                'end_date' => $this->end,
                'tahun' => $this->tahun

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

    public function editManagePelatihan($idEntity)
    {
        try {
            $pelatihan = Pelatihan::findOrFail(decrypt($idEntity));
            $this->nama = $pelatihan->name_pelatihan;
            $this->category = $pelatihan->category_id;
            $this->start = $pelatihan->start_date;
            $this->end = $pelatihan->end_date;
            $this->deskripsi = $pelatihan->description_pelatihan;
            $this->tahun = $pelatihan->tahun;
            $this->idEntity = encrypt($pelatihan->id);
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

    public function updatePelatihan()
    {
        $this->validate([
            'nama' => ['required','unique:pelatihans,name_pelatihan,'.decrypt($this->idEntity)],
            'category' => ['required'],
            'deskripsi' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
            'tahun' => ['tahun']
        ]);

        try{
            $pelatihan = Pelatihan::findOrFail(decrypt($this->idEntity));
            $pelatihan->update([
                'name_pelatihan' => $this->nama,
                'category_id' => $this->category,
                'description_pelatihan' => $this->deskripsi,
                'start_date' => $this->start,
                'end_date' => $this->end,
                'tahun' => $this->tahun
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

    public function deleteManagePelatihan($idEntity)
    {
        try {
            $pelatihan = Pelatihan::findOrFail(decrypt($idEntity));
            $pelatihan->delete();
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