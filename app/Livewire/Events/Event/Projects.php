<?php

namespace App\Livewire\Events\Event;

use Livewire\Component;

class Projects extends Component
{
    public $event;

    public function mount($event)
    {
        $this->event = $event;
    }

    public function render()
    {
        $event = auth()->user()->events()->findOrFail($this->event);

        return view('livewire.events.event.projects', compact('event'))
            ->layout('layouts.event-dashboard');
    }
}
