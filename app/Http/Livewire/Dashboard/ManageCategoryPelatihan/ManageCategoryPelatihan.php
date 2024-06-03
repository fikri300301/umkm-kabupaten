<?php

namespace App\Http\Livewire\Dashboard\ManageCategoryPelatihan;

use App\Models\CategoryPelatihan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ManageCategoryPelatihan extends Component
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
        'editButtonFromGlobal' => 'editManageCategoryPelatihan',
        'deleteButtonFromGlobal' => 'deleteManageCategoryPelatihan',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = CategoryPelatihan::when(!empty($this->search),function($query){
            return $query->where('name_category', 'LIKE', '%' . $this->search . '%');
        })->orderBy('name_category', 'asc')->paginate($this->limitPage);
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
        return view('dashboard.manage-category-pelatihan.livewire.manage-category-pelatihan',[
            'data'=>$this->getAllData(),
        ]);
    }

    public function addManageCategoryPelatihan()
    {
    
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahCategoryPelatihan()
    {
        $this->validate([
            'nama' => ['required','unique:category_pelatihans,name_category','regex:/^[\w\s-]+$/']
        ]);

        try {
            CategoryPelatihan::create([
                'name_category'=>$this->nama
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

    public function editManageCategoryPelatihan($idEntity)
    {
        try {
            $category = CategoryPelatihan::findOrFail(decrypt($idEntity));
            $this->nama = $category->name_category;
            $this->idEntity = encrypt($category->id);
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

    public function updateCategoryPelatihan()
    {
        $this->validate([
            'nama' => ['required','unique:category_pelatihans,name_category','regex:/^[\w\s-]+$/']
        ]);

        try{
            $category = CategoryPelatihan::findOrFail(decrypt($this->idEntity));
            $category->update([
                'name_category' => $this->nama
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

    public function deleteManageCategoryPelatihan($idEntity)
    {
        try {
            $category = CategoryPelatihan::findOrFail(decrypt($idEntity));
            $category->delete();
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