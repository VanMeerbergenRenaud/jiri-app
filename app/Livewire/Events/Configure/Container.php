<?php

namespace App\Livewire\Events\Configure;

use Livewire\Component;

class Container extends Component
{
    public $event;

    public function render()
    {
        return view('livewire.events.configure.container');
    }
}
