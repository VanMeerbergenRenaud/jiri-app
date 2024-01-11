<?php

namespace App\Livewire\Events\Edit;

use Livewire\Component;
use App\Livewire\Forms\EventForm;

class Container extends Component
{
    public $event;
    public EventForm $form;

    public function mount()
    {
        $this->form->setEvent($this->event);
    }

    public function save()
    {
        $this->form->update();

        $this->event->refresh();

        return redirect()->route('events.index');
    }

    public function render()
    {
        return view('livewire.events.edit.container');
    }
}
