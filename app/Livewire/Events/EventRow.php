<?php

namespace App\Livewire\Events;

use App\Livewire\Forms\EventForm;
use Livewire\Component;

class EventRow extends Component
{
    public $event;

    public EventForm $form;

    public $showEditDialog = false;

    public function mount()
    {
        $this->form->setEvent($this->event);
    }

    public function save()
    {
        $this->form->update();

        $this->event->refresh();

        $this->reset('showEditDialog');
    }

    public function render()
    {
        return view('livewire.events.event-row');
    }
}
