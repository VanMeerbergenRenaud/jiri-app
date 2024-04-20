<?php

namespace App\Livewire\Events\Edit;

use App\Livewire\Forms\ContactForm;
use App\Livewire\Forms\EventContactsForm;
use Livewire\Component;

class Form extends Component
{
    public $eventId;

    public function save()
    {
        dd('save');
    }

    public function render()
    {
        return view('livewire.events.edit.form');
    }
}
