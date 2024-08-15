<?php

namespace App\Livewire\Events\Show;

use Carbon\Carbon;
use Livewire\Component;

class Actions extends Component
{
    public $event;

    public $hours = '00';

    public $minutes = '00';

    public $seconds = '00';

    public $eventOnPause = true;

    public $eventNotStarted = true;

    public function mount($event)
    {
        $this->event = $event;

        $this->updateTimer();
    }

    public function updateTimer()
    {
        $now = Carbon::now();
        $startedAt = Carbon::parse($this->event->started_at);
        $finishedAt = Carbon::parse($this->event->finished_at);

        if ($finishedAt !== null) {
            $diff = $finishedAt->diff($startedAt);
        } else {
            $diff = $now->diff($startedAt);
        }

        $this->hours = str_pad($diff->h, 2, '0', STR_PAD_LEFT);
        $this->minutes = str_pad($diff->i, 2, '0', STR_PAD_LEFT);
        $this->seconds = str_pad($diff->s, 2, '0', STR_PAD_LEFT);
    }

    public function startEvent()
    {
        return redirect()->route('events.index');
    }

    public function pauseEvent()
    {
        $this->event->update([
            'paused_at' => now(),
        ]);
    }

    public function continueEvent()
    {
        $this->event->update([
            'paused_at' => null,
        ]);

        $this->reset('eventOnPause');
    }

    public function finishEvent()
    {
        $this->event->update([
            'finished_at' => now(),
        ]);

        return redirect()->route('events.index');
    }

    public function render()
    {
        return view('livewire.events.show.actions');
    }
}
