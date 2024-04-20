<?php

namespace App\Livewire\Events\Edit;

use Livewire\Attributes\Validate;
use Livewire\Component;

class FormProject extends Component
{
    public $eventId;

    public function save()
    {
        dd('save');
    }

    public function render()
    {
        return view('livewire.events.edit.form-project');
    }
}
