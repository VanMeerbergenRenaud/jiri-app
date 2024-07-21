<?php

namespace App\Livewire\Events\Event;

use Livewire\Component;

class Navbar extends Component
{
    public $event;

    public $eventInProgress;

    public function mount()
    {
        $this->event = request()->route('event');
        $this->eventInProgress = auth()->user()->events()
            ->where('id', $this->event)
            ->first();
    }

    public function quitEvent()
    {
        // Todo stop the timer and add a finished time to the event
        $this->eventInProgress->update([
            'finished_at' => now(),
        ]);

        return redirect()->route('events.index');
    }

    public function render()
    {
        return view('livewire.events.event.navbar');
    }
}
