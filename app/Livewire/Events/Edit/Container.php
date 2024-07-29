<?php

namespace App\Livewire\Events\Edit;

use App\Livewire\Forms\EventForm;
use Livewire\Component;

class Container extends Component
{
    public $event;

    public EventForm $form;

    public function mount()
    {
        $this->event = auth()->user()->events()->findOrFail(request()->route('event'));
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
