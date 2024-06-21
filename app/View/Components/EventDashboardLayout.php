<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class EventDashboardLayout extends Component
{
    public $event;

    public function __construct($eventId)
    {
        $this->event = $eventId;
    }

    public function render(): View
    {
        return view('layouts.event-dashboard');
    }
}
