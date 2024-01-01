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
        return Carbon::parse($date)->translatedFormat('d/m/y à H' . ':' . 'i');
    }

    public function formatTime($time)
    {
        Carbon::setLocale('fr');
        $time = Carbon::parse($time);
        $hours = ltrim($time->format('H'), '0');
        $minutes = $time->format('i');

        if ($hours > 0) {
            return $hours . 'h' . $minutes . 'min';
        } else {
            return $minutes . 'min';
        }
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
