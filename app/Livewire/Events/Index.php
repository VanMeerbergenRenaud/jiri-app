<?php

namespace App\Livewire\Events;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $user = auth()->user();

        $events = $user->events()->get();

        return view('livewire.events.index', compact('user', 'events'))
            ->layout('layouts.app');
    }
}
