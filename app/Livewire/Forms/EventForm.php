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

    #[Validate('required|date|after_or_equal:2022-01-01|before_or_equal:2038-01-01')]
    public $starting_at = '';

    #[Validate('required')]
    public $duration = '';

    public function setEvent($event)
    {
        $this->event = $event;
        $this->name = $event->name;
        $this->starting_at = Carbon::parse($event->starting_at)->format('Y-m-d\TH:i'); // format to exclude seconds
        $this->duration = Carbon::parse($event->duration)->format('H:i'); // format to exclude seconds
    }

    public function save()
    {
        $this->validate();

        $this->event = auth()->user()->events()->create([
            'name' => $this->name,
            'starting_at' => $this->starting_at,
            'duration' => $this->duration,
        ]);

        $this->reset(['name', 'starting_at', 'duration']);

        sleep(1);

        // Redirect to the edit page of the newly created event
        return redirect()->route('events.edit', ['event' => $this->event->id]);
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
