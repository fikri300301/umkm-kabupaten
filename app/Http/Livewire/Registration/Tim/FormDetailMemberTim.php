<?php

namespace App\Http\Livewire\Registration\Tim;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ParticipantsEvent;
use App\Models\RequirementsEvent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\RequirementsParticipantsEvent;

class FormDetailMemberTim extends Component
{
    use WithFileUploads;

    public $index;
    public $name;
    public $email;
    public $phone;
    public $eventId;
    public $timId;
    public $member;
    public $requiretment;
    public $action = 'kirim';
    public $participantId;
    public $required;
    public $value;
    public $dataRequiretment;
    public $status;
    public $chageValue = false;
    public function mount()
    {
        $this->member = htmlspecialchars_decode($this->member);
        $this->required = [];
        $this->value = [];
        $this->dataRequiretment = [];
        $this->requirementsEvent();
        if (!empty($this->member)) {
            $this->action = 'update';
            $this->fetchData();
            $this->requirementsParticipant();
        }
    }
    public function getAllDataParticipant()
    {
        $this->member = ParticipantsEvent::with('requirements')->findOrFail(decrypt($this->participantId));
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

    public function fetchDataRequired()
    {
        $data = $this->getAllDataParticipant();
        $this->required = $data;
    }
    public function updatedValue()
    {
        $this->chageValue = true;
    }
    public function fetchData()
    {
        if (is_object($this->member)) {
            $data = $this->member;
        } else {
            $data = json_decode($this->member);
        }
        $this->name = $data->name_participant;
        $this->email = $data->email_participant;
        $this->phone = $data->phone_participant;
        $this->index = $data->leader_participant > 0 ? 1 : $this->index;
        $this->participantId = encrypt($data->id);
        if ($this->required->count() > 0) {
            $this->requirementsParticipant();
        }
    }

    public function render()
    {
        return view('registration.tim.livewire.form-detail-member-tim');
    }

    public function kirim()
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
        ]);
        DB::begintransaction();
        try {
            $participant = ParticipantsEvent::create([
                'name_participant' => $this->name,
                'email_participant' => $this->email,
                'phone_participant' => $this->phone,
                'leader_participant' => $this->index == 1 ? 1 : 0,
                'tim_id' => decrypt($this->timId),
            ]);
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

            DB::commit();
            $this->member = $participant;
            $this->action = 'update';
            $this->fetchData();
            $this->requirementsParticipant();
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('error create participant ', [
                'error' => $th->getMessage(),
            ]);
            $this->dispatchBrowserEvent('errorSuccess');
        }
    }

    public function update()
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
        ]);
        DB::begintransaction();
        try {
            $participant = ParticipantsEvent::findOrFail(decrypt($this->participantId));
            $participant->update([
                'name_participant' => $this->name,
                'email_participant' => $this->email,
                'phone_participant' => $this->phone,
            ]);
            if ($this->chageValue) {
                RequirementsParticipantsEvent::where('participants_events_id', decrypt($this->participantId))
                    ->whereIn('requirements_events_id', $this->required->pluck('id'))
                    ->delete();
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
                        'participants_events_id' => decrypt($this->participantId),
                        'requirements_events_id' => $key,
                        'value' => $values,
                    ]);
                }
            }
            DB::commit();
            $this->member = $participant;
            $this->action = 'update';
            $this->fetchData();
            $this->requirementsParticipant();
            $this->action = 'update';
            $this->dispatchBrowserEvent('messageSuccess');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('error update participant ', [
                'error' => $th->getMessage(),
            ]);
            $this->dispatchBrowserEvent('errorSuccess',[
                'message' => $th->getMessage(),
            ]);
        }
    }
}
