<?php

namespace App\Http\Livewire\Dashboard\ManageRoleAndPermission;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class ManagePermission extends Component
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

    protected $listeners = [
        'editButtonFromGlobal' => 'editPermission',
        'deleteButtonFromGlobal' => 'deletePermission',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = Permission::when(!empty($this->search),function($query){
            return $query->where('name', 'like', '%' . $this->search . '%');
        })->orderBy('name', 'asc')->paginate($this->limitPage);
        return $data;
    }

    public function resetAll()
    {
        $this->nama = '';
        $this->deskripsi = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-role-and-permission.livewire.manage-permission', [
            'data' => $this->getAllData(),
        ]);
    }

    public function addPermission()
    {

        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahPermission()
    {
        $this->validate([
            'nama' => ['required','unique:permissions,name','alpha_dash'],
            'deskripsi' => ['required','max:150'],
        ]);

        try {
            Permission::create([
                'name' => $this->nama,
                'description' => $this->deskripsi,
                'guard_name' => 'web',
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

    public function editPermission($idEntity)
    {
        try {
            $permission = Permission::findOrFail(decrypt($idEntity));
            $this->nama = $permission->name;
            $this->deskripsi = $permission->description;
            $this->idEntity = encrypt($permission->id);
            $this->formAction = "update";
            $this->dispatchBrowserEvent('openFormModal');
        } catch (\Exception $e) {
            Log::error('error edit ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function updatePermission()
    {
        $this->validate([
            'nama' => ['required','unique:permissions,name,'.decrypt($this->idEntity),'alpha_dash'],
            'deskripsi' => ['required','max:150'],
        ]);

        try {
            $permission = Permission::findOrFail(decrypt($this->idEntity));
            $permission->update([
                'name' => $this->nama,
                'description' => $this->deskripsi,
            ]);
            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error update', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function deletePermission($idEntity)
    {
        try {
            $permission = Permission::findOrFail(decrypt($idEntity));
            $permission->delete();
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