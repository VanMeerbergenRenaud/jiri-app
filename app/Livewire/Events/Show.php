<?php

namespace App\Livewire\Events;

use Livewire\Component;

class Show extends Component
{
    public $eventId;

    public $event;

    public function mount($event)
    {
        $this->eventId = $event;
        $this->event = auth()->user()->events()->findOrFail($this->eventId);
    }

    private function updateEvent($field)
    {
        $this->event->$field = now();
        $this->event->save();
    }

    public function startEvent()
    {
        $this->updateEvent('started_at');
    }

    public function pauseEvent()
    {
        $this->updateEvent('paused_at');
    }

    public function endEvent()
    {
        $this->updateEvent('finished_at');
    }

    public function render()
    {
        return view('livewire.events.show')
            ->layout('layouts.event-dashboard');
    }
}
