<?php

namespace App\Livewire\Events\Show;

use Livewire\Component;

class Actions extends Component
{
    public $event;
    public $hours = '00';
    public $minutes = '00';
    public $seconds = '00';

    public function mount($event)
    {
        $this->event = $event;
        $this->hours = '00';
        $this->minutes = '00';
        $this->seconds = '00';
        $this->updateTimer();
    }

    public function updateTimer()
    {
        $now = now();
        $startedAt = $this->event->started_at;
        $diff = $now->diff($startedAt);
        $this->hours = str_pad($diff->h, 2, '0', STR_PAD_LEFT);
        $this->minutes = str_pad($diff->i, 2, '0', STR_PAD_LEFT);
        $this->seconds = str_pad($diff->s, 2, '0', STR_PAD_LEFT);
    }

    public function updateStatus($status)
    {
        switch ($status) {
            case 'started':
                $this->event->update([
                    'started_at' => now(),
                    'paused_at' => null,
                    'finished_at' => null,
                ]);
                break;
            case 'paused':
                $this->event->update([
                    'paused_at' => now(),
                    'finished_at' => null,
                ]);
                break;
            case 'finished':
                $this->event->update([
                    'finished_at' => now(),
                ]);
                break;
        }
    }

    public function render()
    {
        return view('livewire.events.show.actions');
    }
}
