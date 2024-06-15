<?php

namespace App\Livewire\Events;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $events = auth()->user()->events()->get();

        return view('livewire.events.index', compact('events'))
            ->layout('layouts.app');
    }
}
