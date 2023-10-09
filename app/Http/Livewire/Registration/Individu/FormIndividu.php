<?php

namespace App\Http\Livewire\Registration\Individu;

use App\Enum\StatusTim;
use Livewire\Component;
use App\Models\TeamEvent;
use App\Models\ParticipantsEvent;
use App\Models\RequirementsEvent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Rules\UniqueInEventByEventId;
use App\Models\RequirementsParticipantsEvent;
use Livewire\WithFileUploads;

class FormIndividu extends Component
{
    use WithFileUploads;

    public $codeTim;
    public $name;
    public $email;
    public $phone;
    public $instansi;
    public $timId;
    public $url;
    public $status;
    public $action = 'daftar';
    public $eventId;
    public $value;
    public $required;
    public $dataRequiretment;
    public $participant;
    public $chageValue = false;
    public $participantId;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->required = [];
        $this->value = [];
        $this->dataRequiretment = [];
        $this->requirementsEvent();
        if (!empty($this->codeTim)) {
            $this->action = 'update';
            $this->fetchData();
            $this->participants();
            $this->requirementsParticipant();
        } else {
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
            $this->phone = Auth::user()->phone;
            $this->url = URL::full();
        }
    }
    public function participants()
    {
        $participant = ParticipantsEvent::where('tim_id', decrypt($this->timId))->first();
        $this->name = $participant->name_participant;
        $this->participantId = encrypt($participant->id);
    }
    public function getAllData()
    {
        $data = TeamEvent::where('code_tim', $this->codeTim)->first(['id', 'email_tim', 'phone_tim', 'instansi', 'participants_total', 'status_tim']);
        return $data;
    }
    public function requirementsEvent()
    {
        $this->required = RequirementsEvent::where('event_id', decrypt($this->eventId))->get();
    }
    public function requirementsParticipant()
    {
        $this->dataRequiretment = RequirementsParticipantsEvent::when(!empty($this->participantId), function ($query) {
            $query->where('participants_events_id', decrypt($this->participantId));
        })
            ->whereIn('requirements_events_id', $this->required->pluck('id'))
            ->get();
        foreach ($this->required as $item) {
            foreach ($this->dataRequiretment as $data) {
                if ($data->requirements_events_id == $item->id) {
                    $this->value[$item->id] = $data->value;
                }
            }
        }
    }
    public function fetchData()
    {
        $data = $this->getAllData();
        $this->name = $data->name;
        $this->email = $data->email_tim;
        $this->phone = $data->phone_tim;
        $this->instansi = $data->instansi;
        $this->status = $data->status_tim;
        $this->timId = encrypt($data->id);
    }
    public function fetchDataRequired()
    {
        $data = $this->getAllDataParticipant();
        $this->required = $data;
    }
    public function updatedValue()
    {
        $this->chageValue = true;
    }
    public function render()
    {
        return view('registration.individu.livewire.form-individu', [
            'data' => $this->getAllData(),
        ]);
    }

    public function daftar()
    {
        $this->validate([
            'email' => ['required', 'email', new UniqueInEventByEventId(decrypt($this->eventId))],
            'phone' => ['required', 'regex:/^(\+62|62|0)8[0-9][0-9]{6,14}/', new UniqueInEventByEventId(decrypt($this->eventId))],
            'instansi' => ['required'],
            'name' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $tim = TeamEvent::create([
                'email_tim' => $this->email,
                'phone_tim' => $this->phone,
                'instansi' => $this->instansi,
                'event_id' => decrypt($this->eventId),
                'status_tim' => StatusTim::Waiting,
                'participants_total' => 1,
                'user_participants_id' => Auth::id(),
            ]);
            $participant = ParticipantsEvent::create([
                'tim_id' => $tim->id,
                'name_participant' => $this->name,
                'email_participant' => $this->email,
                'phone_participant' => $this->phone,
                'leader_participant' => 1,
            ]);
            if ($this->chageValue) {
                foreach ($this->value as $key => $value) {
                    if ($value instanceof UploadedFile && $value->isFile()) {
                        $this->validate([
                            'value.'.$key => 'mimes:jpg,bmp,png,gif,webp,pdf,word',
                        ]);
                        $values = 'storage/' . $value->store('events');
                    } else {
                        $values = $value;
                    }
                    RequirementsParticipantsEvent::create([
                        'participants_events_id' => $participant->id,
                        'requirements_events_id' => $key,
                        'value' => $values,
                    ]);
                }
            }
            DB::commit();
            $this->dispatchBrowserEvent('messageSuccess');
            return redirect($this->url . "/$tim->code_tim");
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('error create tim ', [
                'error' => $th->getMessage(),
            ]);
            $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function update()
    {
        $this->validate([
            'email' => ['required', 'email', new UniqueInEventByEventId(decrypt($this->eventId), $this->codeTim)],
            'phone' => ['required','regex:/^(\+62|62|0)8[0-9][0-9]{6,14}/', new UniqueInEventByEventId(decrypt($this->eventId), $this->codeTim)],
            'instansi' => ['required'],
            'name' => ['required'],
        ]);
        DB::beginTransaction();
        try {
            TeamEvent::where('code_tim', $this->codeTim)->update([
                'email_tim' => $this->email,
                'phone_tim' => $this->phone,
                'instansi' => $this->instansi,
            ]);
            ParticipantsEvent::findOrFail(decrypt($this->participantId))->update([
                'name_participant' => $this->name,
                'email_participant' => $this->email,
                'phone_participant' => $this->phone,
            ]);
            if ($this->chageValue) {
                RequirementsParticipantsEvent::where('participants_events_id', decrypt($this->participantId))
                    ->whereIn('requirements_events_id', $this->required->pluck('id'))
                    ->delete();
                foreach ($this->value as $key => $value) {
                    $this->validate([
                        'value.'.$key => 'mimes:jpg,bmp,png,gif,webp,pdf,word',
                    ]);
                    if ($value instanceof UploadedFile && $value->isFile()) {
                        $values = 'storage/' . $value->store('events');
                    } else {
                        $values = $value;
                    }
                    RequirementsParticipantsEvent::create([
                        'participants_events_id' => decrypt($this->participantId),
                        'requirements_events_id' => $key,
                        'value' => $values,
                    ]);
                }
            }
            DB::commit();
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Throwable $th) {
            Log::error('error update individu ', [
                'error' => $th->getMessage(),
            ]);
            $this->dispatchBrowserEvent('errorSuccess');
        }
    }
}
