<?php

namespace App\Livewire;

use Livewire\Component;

class WelcomeMessage extends Component
{
    public $title;
    public $message;

    public function render()
    {
        return view('livewire.welcome-message');
    }
}
