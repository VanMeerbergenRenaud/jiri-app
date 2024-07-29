<?php

namespace App\Livewire\Events;

use Livewire\Component;

class Edit extends Component
{
    public $event;

    public function mount($event)
    {
        $this->event = auth()->user()->events()->findOrFail($event);
    }

    public function render()
    {
        return view('livewire.events.edit')
            ->layout('layouts.app');
    }
}
