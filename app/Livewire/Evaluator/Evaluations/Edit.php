<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Component;

class Edit extends Component
{
    public $event;
    public $contact;
    public $token;

    public $projects;

    public function mount($event, $contact, $token)
    {
        $this->event = auth()->user()->events()
            ->findOrFail($event);
        $this->contact = auth()->user()->contacts()
            ->findOrFail($contact);
        $this->token = $token;

        $this->projects = $this->event->projects;
    }

    public function render()
    {
        return view('livewire.evaluator.evaluations.edit')
            ->layout('layouts.evaluator');
    }
}
