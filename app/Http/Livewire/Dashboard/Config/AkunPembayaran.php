<?php

namespace App\Http\Livewire\Dashboard\Config;

use Livewire\Component;
use App\Enum\PublishOrDraft;
use Livewire\WithPagination;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\Log;

class AkunPembayaran extends Component
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
    public $type;
    public $number;
    public $status;
    public $status_pembayaran;

    protected $listeners = [
        'editButtonFromGlobal' => 'editAkun',
        'deleteButtonFromGlobal' => 'deleteAkunPembayaran',
        'refresh' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->status_pembayaran = PublishOrDraft::cases();
    }
    public function getAllData()
    {
        $data = PaymentAccount::when(!empty($this->search), function ($query) {
            return $query
                ->where('name_account', 'LIKE', '%' . $this->search . '%')
                ->OrWhere('type_account', 'LIKE', '%' . $this->search . '%')
                ->orWhere('number_account', 'LIKE', '%' . $this->search . '%');
        })
            ->orderBy('name_account', 'asc')
            ->paginate($this->limitPage);
        return $data;
    }

    public function resetAll()
    {
        $this->nama = '';
        $this->type = '';
        $this->number = '';
        $this->status = '';
        $this->showModal = false;
        $this->formAction = '';
        $this->idEntity = null;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeFormModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('dashboard.config.akun-pembayaran.livewire.akun-pembayaran', [
            'data' => $this->getAllData(),
        ]);
    }

    public function addAkunPembayaran()
    {
        $this->formAction = 'tambah';
        $this->showModal = true;
        $this->dispatchBrowserEvent('openFormModal');
    }

    public function tambahAkun()
    {
        $this->validate([
            'nama' => ['required', 'min:2', 'max:100'],
            'type' => ['required', 'min:2', 'max:100'],
            'number' => ['required', 'min:2', 'max:100'],
            'status' => ['required', 'min:2', 'max:100'],
        ]);

        try {
            PaymentAccount::create([
                'name_account' => $this->nama,
                'type_account' => $this->type,
                'number_account' => $this->number,
                'status_account' => $this->status,
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

    public function editAkun($idEntity)
    {
        try {
            $pay = PaymentAccount::findOrFail(decrypt($idEntity));
            $this->nama = $pay->name_account;
            $this->type = $pay->type_account;
            $this->number = $pay->number_account;
            $this->status = $pay->status_account;
            $this->idEntity = encrypt($pay->id);
            $this->showModal = true;
            $this->formAction = 'update';
            $this->dispatchBrowserEvent('openFormModal');
        } catch (\Exception $e) {
            Log::error('error edit ', [
                'error' => $e->getMessage(),
            ]);
            return $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function updateAkun()
    {
        $this->validate([
            'nama' => ['required', 'min:2', 'max:100'],
            'type' => ['required', 'min:2', 'max:100'],
            'number' => ['required', 'min:2', 'max:100'],
            'status' => ['required', 'min:2', 'max:100'],
        ]);

        try {
            $pay = PaymentAccount::findOrFail(decrypt($this->idEntity));
            $pay->update([
                'name_account' => $this->nama,
                'type_account' => $this->type,
                'number_account' => $this->number,
                'status_account' => $this->status,
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

    public function deleteAkunPembayaran($idEntity)
    {
        try {
            $pay = PaymentAccount::findOrFail(decrypt($idEntity));
            $pay->delete();
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
