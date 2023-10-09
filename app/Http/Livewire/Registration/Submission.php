<?php

namespace App\Http\Livewire\Registration;

use Livewire\Component;
use App\Models\TeamEvent;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class Submission extends Component
{
    public $codeTim;
    public $submission;
    public $status;
    public function mount(){
        if(!empty($this->codeTim)){
            $this->fetchData();
        }
    }
    public function getAllData()
    {
        $data = TeamEvent::where('code_tim', $this->codeTim)->first(['result','status_tim']);
        return $data;
    }
    public function fetchData(){
        $data = $this->getAllData();
        $this->submission = $data->result;
        $this->status = $data->status_tim;
    }
    public function render()
    {
        return view('registration.livewire.submission');
    }
    public function store(){
       try {
        TeamEvent::where('code_tim', $this->codeTim)->update([
            'result' => $this->submission
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
