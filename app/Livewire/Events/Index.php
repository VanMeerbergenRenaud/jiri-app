<?php

namespace App\Livewire\Events;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.events.index')
            ->layout('layouts.app');
    }
}
