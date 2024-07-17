<?php

namespace App\Livewire\Events\Event;

use Livewire\Component;

class Students extends Component
{
    public $event;

    public function mount()
    {
        $this->event = auth()->user()->events()->findOrFail(request()->event);
    }

    public function render()
    {
        return view('livewire.events.event.students')
            ->layout('layouts.event-dashboard');
    }
}
