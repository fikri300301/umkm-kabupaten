<?php

namespace App\Http\Livewire\Registration\Tim;

use App\Enum\StatusTim;
use Livewire\Component;
use App\Models\TeamEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Rules\UniqueInEventByEventId;

class FormTim extends Component
{
    public $codeTim;
    public $email;
    public $phone;
    public $instansi;
    public $participant;
    public $maxParticipant;
    public $isFix;
    public $url;
    public $status;
    public $action = 'daftar';
    public $eventId;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount(){
        if(!empty($this->codeTim)){
            $this->action = 'update';
            $this->fetchData();
        }else{
            $this->url = URL::full();
            $this->email = Auth::user()->email;
            $this->phone = Auth::user()->phone;
        }
    }

    public function getAllData(){
        $data = TeamEvent::where('code_tim',$this->codeTim)->first(['email_tim', 'phone_tim','instansi','participants_total', 'status_tim']);
        return $data;
    }
    public function fetchData(){
        $data = $this->getAllData();
        $this->email = $data->email_tim;
        $this->phone = $data->phone_tim;
        $this->instansi = $data->instansi;
        $this->participant = $data->participants_total;
        $this->status = $data->status_tim;
    }
    public function render()
    {
        return view('registration.tim.livewire.form-tim');
    }
    public function daftar(){
        $this->validate([
            'email' => ['required', 'email', new UniqueInEventByEventId(decrypt($this->eventId))],
            'phone' => ['required', 'regex:/^(\+62|62|0)8[0-9][0-9]{6,14}/',new UniqueInEventByEventId(decrypt($this->eventId))],
            'instansi' => ['required', 'min:2'],
            'participant' => ['required', 'numeric', 'min:2', "max:$this->maxParticipant"]
        ]);
        try {
            $tim = TeamEvent::create([
                'email_tim' => $this->email,
                'phone_tim' => $this->phone,
                'instansi' => $this->instansi,
                'event_id' => decrypt($this->eventId),
                'status_tim' => StatusTim::Waiting,
                'participants_total' => $this->participant,
                'user_participants_id' => Auth::id(),
            ]);
            $this->dispatchBrowserEvent('messageSuccess');
            return redirect($this->url."/$tim->code_tim");
        } catch (\Throwable $th) {
            Log::error('error create tim ', [
                'error' => $th->getMessage(),
            ]);
            $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function update(){
        $this->validate([
            'email' => ['required', 'email',new UniqueInEventByEventId(decrypt($this->eventId), $this->codeTim)],
            'phone' => ['required','regex:/^(\+62|62|0)8[0-9][0-9]{6,14}/', new UniqueInEventByEventId(decrypt($this->eventId), $this->codeTim)],
            'instansi' => ['required'],
            'participant' => ['required', 'numeric', 'min:2', "max:$this->maxParticipant"]
        ]);

        try {
            TeamEvent::where('code_tim',$this->codeTim)->where('event_id',decrypt($this->eventId))->update([
                'email_tim' => $this->email,
                'phone_tim' => $this->phone,
                'instansi' => $this->instansi,
            ]);
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Throwable $th) {
            Log::error('error create tim ', [
                'error' => $th->getMessage(),
            ]);
            $this->dispatchBrowserEvent('errorSuccess');
        }
    }

}
