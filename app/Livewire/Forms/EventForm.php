<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventForm extends Form
{
    public $event;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required')]
    public $starting_at = '';

    #[Validate('required')]
    public $duration = '';

    public function setEvent($event)
    {
        $this->event = $event;
        $this->name = $event->name;
        $this->starting_at = Carbon::parse($event->starting_at)->format('Y-m-d\TH:i');
        $this->duration = Carbon::parse($event->duration)->format('H:i');
    }

    public function save()
    {
        $this->validate();

        auth()->user()->events()->create([
            'name' => $this->name,
            'starting_at' => $this->starting_at,
            'duration' => $this->duration,
        ]);

        $this->reset(['name', 'starting_at', 'duration']);
    }

    public function update()
    {
        $this->validate();

        $this->event->update([
            'name' => $this->name,
            'starting_at' => $this->starting_at,
            'duration' => $this->duration,
        ]);
    }
}
