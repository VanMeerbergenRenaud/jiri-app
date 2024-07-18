<?php

namespace App\Livewire\Events;

use App\Livewire\Forms\EventForm;
use Livewire\Component;

class AddEventDialog extends Component
{
    public EventForm $form;

    public $show = false;
    public $added = false;

    public function add()
    {
        $this->form->save();
        $this->reset('show');
        $this->added = true;
    }

    public function render()
    {
        return view('livewire.events.add-event-dialog');
    }
}
