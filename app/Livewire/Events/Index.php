<?php

namespace App\Livewire\Events;

use Livewire\Component;

class Index extends Component
{
    public $events;

    public function mount()
    {
        $this->events = auth()->user()->events;
    }

    public function render()
    {
        return view('livewire.events.index')
            ->layout('layouts.app');
    }
}
