<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TeamEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class TeamEventController extends Controller
{
    public function create(Request $request){
        $event = Event::withCount('tim')->where('slug_event', $request->slug)->where('registration_event', 'team')->first(['id','fixed_participant','registration_event','type_event', 'name_event', 'maximal_participant']);
        if(is_null($event)) return redirect('/');
        $tim = TeamEvent::where('event_id',$event->id)->where('user_participants_id', Auth::id())->first(['code_tim']);
        if(!is_null($tim)) return redirect(URL::full()."/$tim->code_tim");
        if ($event->quota <= $event->tim_count ) return redirect('/');
        $now = Carbon::now();
        if (!$now->between($event->start_event,$event->end_event)) return redirect('/');
        return view('registration.tim.tim',[
            'eventId' => $event->id,
            'eventName' => $event->name_event,
            'eventMaximalParticipant' => $event->maximal_participant,
            'codeTim' => null,
            'isFix' => $event->fixed_participant,
        ]);
    }

    public function update(Request $request){
        $event = Event::where('slug_event', $request->slug)->where('registration_event', 'team')->first(['id', 'name_event', 'maximal_participant','registration_event','type_event', 'task_event']);
        if(is_null($event)) return redirect('/');
        $tim = TeamEvent::where('code_tim', $request->codeTim)->where('event_id',$event->id)->where('user_participants_id', Auth::id())->first();
        if(is_null($tim)) return redirect('/');
        return view('registration.tim.tim',[
            'eventId' => $event->id,
            'eventName' => $event->name_event,
            'type' => $event->type_event,
            'task' => $event->task_event,
            'eventMaximalParticipant' => $event->maximal_participant,
            'codeTim' => $tim->code_tim,
            'email' => $tim->email_tim,
            'message_tim' => $tim->message_tim,
            'status' => $tim->status_tim
        ]);
    }
    public function individuCreate(Request $request){
        $event = Event::withCount('tim')->where('slug_event', $request->slug)->where('registration_event', 'individu')->first(['id','registration_event','type_event', 'name_event', 'maximal_participant']);
        if(is_null($event)) return redirect('/');
        $tim = TeamEvent::where('event_id',$event->id)->where('user_participants_id', Auth::id())->first(['code_tim']);
        if(!is_null($tim)) return redirect(URL::full()."/$tim->code_tim");
        if ($event->quota <= $event->tim_count ) return redirect('/');
        $now = Carbon::now();
        if ($now->between($event->start_event,$event->end_event)) return redirect('/');
        return view('registration.individu.individu',[
            'eventId' => $event->id,
            'eventName' => $event->name_event,
            'eventMaximalParticipant' => $event->maximal_participant,
            'codeTim' => null,
        ]);
    }
    public function individuUpdate(Request $request){
        $event = Event::where('slug_event', $request->slug)->where('registration_event', 'individu')->first(['id', 'name_event', 'maximal_participant','registration_event','type_event', 'task_event']);
        if(is_null($event)) return redirect('/');
        $tim = TeamEvent::where('code_tim', $request->codeTim)->where('event_id',$event->id)->where('user_participants_id', Auth::id())->first();
        if(is_null($tim)) return redirect('/');
        return view('registration.individu.individu',[
            'eventId' => $event->id,
            'eventName' => $event->name_event,
            'type' => $event->type_event,
            'task' => $event->task_event,
            'eventMaximalParticipant' => $event->maximal_participant,
            'codeTim' => $tim->code_tim,
            'email' => $tim->email_tim,
            'message_tim' => $tim->message_tim,
            'status' => $tim->status_tim
        ]);
    }
}
