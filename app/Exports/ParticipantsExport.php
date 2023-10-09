<?php

namespace App\Exports;

use App\Models\ParticipantsEvent;
use App\Models\TeamEvent;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Event;

class ParticipantsExport implements FromView
{
    private $idEvent;
    public function __construct($idEvent)
    {
        $this->idEvent = $idEvent;
    }
    public function view(): View
    {
        return view('dashboard.manage-participant.export-participant', [
            'data' => TeamEvent::with(['checkerParticipants','members'])->where('event_id', $this->idEvent)->get(),
            'event' => Event::with(['requirements'])->where('id', $this->idEvent)->first(),
        ]);
    }
}
