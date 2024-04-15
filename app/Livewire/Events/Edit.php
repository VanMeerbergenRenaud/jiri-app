<?php

namespace App\Livewire\Events;

use Livewire\Component;

class Edit extends Component
{
    public $eventId;

    public function mount($event)
    {
        $this->eventId = $event;
    }

    public function render()
    {
        $user = auth()->user();

        $event = $user->events()->findOrFail($this->eventId);

        return view('livewire.events.edit', compact('user', 'event'))
            ->layout('layouts.app');
    }
}
