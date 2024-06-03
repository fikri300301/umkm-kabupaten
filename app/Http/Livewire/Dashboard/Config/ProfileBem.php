<?php

namespace App\Http\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class ProfileBem extends Component
{
    use WithPagination;
    use WithFileUploads;

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
    public $key;
    protected $listeners = [
        'editButtonFromGlobal' => 'editProfileBem',
        'deleteButtonFromGlobal' => 'deleteProfileBem',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data = Config::when(!empty($this->search),function($query){
            return $query->where('id', 'LIKE', '%' . $this->search . '%');
        })->orderBy('id', 'asc')->paginate($this->limitPage);
        return $data;
    }

    public function render()
    {
        return view('dashboard.config.profile-bem.livewire.profile-bem',[
            'data'=>$this->getAllData(),
        ]);
    }

    public function addProfileBem()
    {
        return to_route('create-bem');
    }

}
