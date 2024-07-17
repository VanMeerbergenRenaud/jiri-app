<?php

namespace App\Livewire\Events\Event;

use Livewire\Component;

class Projects extends Component
{
    public $event;

    public function mount()
    {
        $this->event = auth()->user()->events()->findOrFail(request()->event);
    }

    public function render()
    {
        return view('livewire.events.event.projects')
            ->layout('layouts.event-dashboard');
    }
}
