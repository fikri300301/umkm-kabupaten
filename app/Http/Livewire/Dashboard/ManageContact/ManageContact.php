<?php

namespace App\Http\Livewire\Dashboard\ManageContact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ManageContact extends Component
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

    public $name;
    public $email;

    public $subject;
    public $body;
    public $user;
    protected $listeners = [
        'editButtonFromGlobal' => 'editManageContact',
        'deleteButtonFromGlobal' => 'deleteManageContact',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAllData()
    {
        $data= Contact::with(['user'])->when(!empty($this->search),function($query){
            return $query->where('name_contact',"LIKE",'%'.$this->search . '%');
        })->orderBy('name_contact','asc')->paginate($this->limitPage);
        return $data;
    }

     public function resetAll()
    {
        $this->name;
        $this->email;
        $this->subject;
        $this->body;
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.manage-contact.livewire.manage-contact',[
            'data'=>$this->getAllData(),
        ]);
    }

    public function addManageContact()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }
    public function editManageContact($idEntity)
    {
        try {
            $contact = Contact::findOrFail(decrypt($idEntity));
            if (is_null($contact->user_id)) {
                $contact->users_id = Auth::id();
                $contact->save();
            }
            $this->name = $contact->name_contact;
            $this->email = $contact->email_contact;
            $this->subject = $contact->subject_contact;
            $this->body = $contact->body_contact;
            $this->showModal = true;
            $this->formAction = "Detail";
            $this->dispatchBrowserEvent('openFormModal');
        }catch (\Exception $e) {
            Log::error('error edit ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }
    public function deleteManageContact($idEntity)
    {
        try {
            $contact = Contact::findOrFail(decrypt($idEntity));
            $contact->delete();
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
