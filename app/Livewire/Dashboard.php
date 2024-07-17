<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $user;

    public $events;

    public $availableEvent;
    public $currentEvent;
    public $pausedEvent;
    public $finishedEvent;

    public $timerStarted = false;

    public function mount()
    {
        $this->user = auth()->user();
        $this->events = $this->user->events;

        $this->availableEvent = $this->user->events()
            ->where('starting_at', '<=', now())
            ->where('started_at', '=', null)
            ->where('paused_at', '=', null)
            ->where('finished_at', '=', null)
            ->get();

        $this->currentEvent = $this->user->events()
            ->where('started_at', '!=', null)
            ->where('paused_at', '=', null)
            ->where('finished_at', '=', null)
            ->get();

        $this->pausedEvent = $this->user->events()
            ->where('started_at', '!=', null)
            ->where('paused_at', '!=', null)
            ->where('finished_at', '=', null)
            ->get();

        $this->finishedEvent = $this->user->events()
            ->where('finished_at', '!=', null)
            ->get();
    }

    // Start the event by adding a timer from 00:00:00 to the started_at column
    public function startEvent($eventId)
    {
        $event = $this->user->events()->findOrFail($eventId);
        $event->started_at = '00:00:00';
        $event->save();

        $this->timerStarted = true;

        //return redirect()->route('events.show', $eventId);
    }

    // Pause the event by adding a timer from the paused_at column to the resumed_at column
    public function pauseEvent($eventId)
    {
        dd('pauseEvent');
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.app');
    }
}
