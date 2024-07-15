<?php

namespace App\Livewire\Events\Event;

use Livewire\Component;

class Evaluators extends Component
{
    public $event;

    public function mount($event)
    {
        $this->event = auth()->user()->events()->findOrFail($event);
    }

    public function render()
    {
        return view('livewire.events.event.evaluators')
            ->layout('layouts.event-dashboard');
    }
}
