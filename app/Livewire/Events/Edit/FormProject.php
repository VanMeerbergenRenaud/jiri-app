<?php

namespace App\Livewire\Events\Edit;

use Livewire\Component;

class FormProject extends Component
{
    public $event;

    public function mount($event)
    {
        $this->event = $event;
    }

    public function save()
    {
        dd('save');
    }

    public function render()
    {
        return view('livewire.events.edit.form-project');
    }
}
