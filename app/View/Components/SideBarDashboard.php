<?php

namespace App\View\Components;

use Closure;
use App\Models\Event;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SideBarDashboard extends Component
{
    /**
     * Create a new component instance.
     */
    protected $event;

    public function __construct()
    {
        // $this->event = Event::where('status_event', 'publish')->get(['name_event', 'slug_event']);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.partials.sidebar',[
            'event' => $this->event
        ]);
    }
}