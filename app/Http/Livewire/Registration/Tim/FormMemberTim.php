<?php

namespace App\Http\Livewire\Registration\Tim;

use Livewire\Component;
use App\Models\TeamEvent;
class FormMemberTim extends Component
{
    public $codeTim;
    public $eventId;
    public $total;
    public $member;
    public $timId;
    public $status;
    
    public function mount(){
        if(!empty($this->codeTim)){
            $this->fetchData();
        }
    }
    public function getAllData(){
        $data = TeamEvent::with(['members'])->where('code_tim', $this->codeTim)->first();
        return $data;
    }
    public function fetchData(){
        $data = $this->getAllData();
        $this->total = $data->participants_total;
        $this->member = $data->members;
        $this->timId = encrypt($data->id);
    }

    public function render()
    {
        return view('registration.tim.livewire.form-member-tim');
    }
}
