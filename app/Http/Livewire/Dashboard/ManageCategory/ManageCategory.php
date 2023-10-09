<?php

namespace App\Http\Livewire\Dashboard\ManageCategory;

use App\Enum\PublishOrDraft;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ManageCategory extends Component
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
    public $angka;
    public $status;
    public $status_category = [];

    protected $listeners = [
        'editButtonFromGlobal' => 'editManageCategory',
        'deleteButtonFromGlobal' => 'deleteManageCategory',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
 $data = Category::when(!empty($this->search),function($query){
            return $query->where('name_category', 'LIKE', '%' . $this->search . '%');
        })->orderBy('name_category', 'asc')->paginate($this->limitPage);
        return $data;
       
    }

     public function resetAll()
    {
        $this->nama = '';
        $this->angka = '';
        $this->status = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function mount(){
        $this->status_category = PublishOrDraft::cases();
    }

    public function render()
    {
        return view('dashboard.manage-category.livewire.manage-category',[
            'data'=> $this->getAllData(),
        ]);
    }

    public function addManageCategory()
    {

        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahCategory()
    {
        $this->validate([
            'nama' => ['required','unique:categories,name_category','regex:/^[\w\s-]+$/'],
            'angka' => ['required'],
            'status' => ['required'],
        ]);

        try {
            Category::create([
                'name_category' => $this->nama,
                'status_category' => $this->status,
                'angka' => $this->angka
            ]);
            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            $this->resetAll();
            Log::error('error store category ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function editManageCategory($idEntity)
    {
        try {
            $category = Category::findOrfail(decrypt($idEntity));
            $this->nama = $category->name_category;
            $this->angka = $category->angka;
            $this->status = $category->status_category;
            $this->idEntity = encrypt($category->id);
            $this->showModal = true;
            $this->formAction = "update";
            $this->dispatchBrowserEvent('openFormModal');
        }catch (\Exception $e) {
            Log::error('error edit category ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function updateCategory()
    {
        $this->validate([
            'nama' =>['required','unique:categories,name_category,'.decrypt($this->idEntity)],
            'angka' => ['required'],
            'status' => ['required'],
        ]);

        try{
            $category = Category::findOrFail(decrypt($this->idEntity));
            $category->update([
                'name_category' => $this->nama,
                'status_category' => $this->status,
                'angka' => $this->angka
            ]);
            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        }catch (\Exception $e) {
            Log::error('error update category', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function deleteManageCategory($idEntity)
    {
        try {
            $category = Category::findOrFail(decrypt($idEntity));
            $category->delete();
            $this->emit('refresh');
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error delete category', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }



}