<?php

namespace App\Http\Livewire\Dashboard\ManageRoleAndPermission;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class ManageRole extends Component
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
    public $permission = [];

    // from form
    public $permissions_role = [];
    public $deskripsi;
    public $nama;

    protected $listeners = [
        'editButtonFromGlobal' => 'editRole',
        'deleteButtonFromGlobal' => 'deleteRole',
        'refresh' => '$refresh',
    ];
    public function mount()
    {
        $this->permission = Permission::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = Role::with(['permissions'])->when(!empty($this->search), function ($query){
            $query->where('name', 'like', '%' . $this->search . '%');
        })->orderBy('name', 'asc')->paginate($this->limitPage);
        return $data;
    }
    public function dehydrate()
    {
        $this->emit('select2');
    }

    public function resetAll()
    {
        $this->permissions_role = [];
        $this->deskripsi;
        $this->nama;
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-role-and-permission.livewire.manage-role', [
            'data' => $this->getAllData(),
        ]);
    }

    public function addRole()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahRole()
    {
        $this->validate([
            'nama' => ['required','unique:roles,name','alpha_dash'],
            'deskripsi' => ['required','max:100'],
            'permissions_role' => ['required','array','min:1'],
        ]);

        try {
            $newRole = Role::create([
                'name' => $this->nama,
                'description' => $this->deskripsi,
                'guard_name' => 'web',
            ]);
            $newRole->givePermissionTo($this->permissions_role);
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

    public function editRole($idEntity)
    {
        try {
            $role = Role::findOrFail(decrypt($idEntity));
            $this->idEntity = encrypt($role->id);
            $this->nama = $role->name;
            $this->deskripsi = $role->description;
            $this->permissions_role = $role->permissions->pluck('name');
            $this->formAction = "update";
            $this->showModal = true;
            $this->dispatchBrowserEvent('openFormModal');
        } catch (\Exception $e) {
            Log::error('error edit ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function updateRole()
    {
        $this->validate([
            'nama' => ['required','alpha_dash','unique:roles,name,' .decrypt($this->idEntity)],
            'deskripsi' => ['required','max:100'],
            'permissions_role' => ['required','array','min:1'],
        ]);

        try {
            $role = Role::findOrFail(decrypt($this->idEntity));
            $role->update([
                 'name' => $this->nama,
                 'description' => $this->deskripsi,
             ]);
             $role->syncPermissions($this->permissions_role);
            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Exception $e) {
            Log::error('error update', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function deleteRole($idEntity)
    {
        try {
            $role = Role::findOrFail(decrypt($idEntity));
            $role->delete();
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