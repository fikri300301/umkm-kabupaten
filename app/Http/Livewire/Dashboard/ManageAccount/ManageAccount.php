<?php

namespace App\Http\Livewire\Dashboard\ManageAccount;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ManageAccount extends Component
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

    protected $listeners = [
        'editButtonFromGlobal' => 'editManageAccount',
        'deleteButtonFromGlobal' => 'deleteManageAccount',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {

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
        return view('dashboard.manage-account.livewire.manage-account',[
            'data'=>Auth::user(),
        ]);
    }

    public function addManageAccount()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahManageAccount()
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

    public function editManageAccount($idEntity)
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

    public function updateManageAccount()
    {
        $this->validate([

        ]);

        try{
            $this->resetAll();
            $this->dispatchBrowserEvent('messageSuccess');
        }catch (\Exception $e) {
            Log::error('error update', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function deleteManageAccount($idEntity)
    {
        try {
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