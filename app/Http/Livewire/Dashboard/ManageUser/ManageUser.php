<?php

namespace App\Http\Livewire\Dashboard\ManageUser;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class ManageUser extends Component
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


    public $nama = '';
    public $email = '';
    public $nomor_HP = '';
    public $role = [];
    public $peran = '';


    protected $listeners = [
        'editButtonFromGlobal' => 'editUser',
        'deleteButtonFromGlobal' => 'deleteUser',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = User::when(!empty($this->search),function($query){
            return $query->where('name', 'like', '%' . $this->search . '%');
        })->orderBy('name', 'asc')->paginate($this->limitPage);
        return $data;
    }

     public function resetAll()
    {
        $this->nama = '';
        $this->email = '';
        $this->nomor_HP = '';
        $this->peran = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-users.livewire.manage-user',[
            'data'=>$this->getAllData(),
        ]);
    }

    public function editUser($idEntity)
    {
        try {
            $user = User::findOrFail(decrypt($idEntity));
            $this->idEntity = encrypt($user->id);
            $this->nama = $user->name;
            $this->email = $user->email;
            $this->nomor_HP = $user->phone;
            $this->peran = $user->getRoleNames()->first();
            if (empty($this->role)) {
                $this->role = Role::all();
            }
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

    public function updateUser()
    {
        $this->validate([
            'peran' => ['required'],
        ]);

        try{
            $user = User::findOrFail(decrypt($this->idEntity));
            $user->syncRoles($this->peran);
            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        }catch (\Exception $e) {
            Log::error('error update', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function deleteUser($idEntity)
    {
        try {
            $user = User::findOrFail(decrypt($idEntity));
            $user->delete();
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
