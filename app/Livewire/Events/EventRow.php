<?php

namespace App\Livewire\Events;

use App\Livewire\Forms\EventForm;
use Carbon\Carbon;
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

    public function formatDate($date)
    {
        Carbon::setLocale('fr');
        return Carbon::parse($date)->translatedFormat('d D M Y');
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
