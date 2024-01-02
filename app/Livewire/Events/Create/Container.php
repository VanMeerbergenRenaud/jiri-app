<?php

namespace App\Livewire\Events\Create;

use Livewire\Component;

class Container extends Component
{
    public $event;

    public function render()
    {
        return view('livewire.events.create.container');
    }
}
