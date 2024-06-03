<?php

namespace App\Http\Livewire\Registration;

use Livewire\Component;
use App\Models\TeamEvent;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class Payment extends Component
{
    use WithFileUploads;

    public $codeTim;
    public $namaAkun;
    public $proofPaymentHad;
    public $proofPayment;
    public $pricePayment;
    public $status;

    public $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount(){
        if(!empty($this->codeTim)){
            $this->fetchData();
        }
    }
    public function getAllData()
    {
        $data = TeamEvent::where('code_tim', $this->codeTim)->first(['name_payment','proof_payment','price_payment','status_tim']);
        return $data;
    }
    public function fetchData(){
        $data = $this->getAllData();
        $this->namaAkun = $data->name_payment;
        $this->proofPaymentHad = $data->proof_payment;
        $this->pricePayment = $data->price_payment;
        $this->status = $data->status_tim;
    }
    public function render()
    {
        return view('registration.livewire.payment');
    }

    public function updatePayment(){
        try {
            if (!empty($this->proofPayment)) {
                $location = $this->proofPayment->store('payment_event');
            }else{
                $location = $this->proofPaymentHad;
            }
            TeamEvent::where('code_tim', $this->codeTim)->update([
                'name_payment' => $this->namaAkun,
                'proof_payment' => 'storage/'.$location,
                'price_payment' => $this->pricePayment,
            ]);
            $this->dispatchBrowserEvent('messageSuccess');
            $this->emit('refresh');
            $this->fetchData();
        } catch (\Throwable $th) {
            Log::error('error create tim ', [
                'error' => $th->getMessage(),
            ]);
            $this->dispatchBrowserEvent('errorSuccess');
        }
    }
}
