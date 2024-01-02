<?php

namespace App\Livewire\Events\Edit;

use Livewire\Component;

class Container extends Component
{
    public $event;

    public function render()
    {
        return view('livewire.events.edit.container');
    }
}
