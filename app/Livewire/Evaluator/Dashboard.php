<?php

namespace App\Livewire\Evaluator;

use Livewire\Component;

class Dashboard extends Component
{
    public $events;
    public $evaluator;

    public function mount()
    {
        $this->evaluator = auth()->user()->contacts()
            ->findOrFail(request()->contact);

        // Get all the events of the contact where he is an evaluator only
        $this->events = auth()->user()->eventContacts()
            ->where('role', 'evaluator')
            ->where('contact_id', $this->evaluator->id)
            ->get();
    }

    public function render()
    {
        return view('livewire.evaluator.dashboard')
            ->layout('layouts.evaluator');
    }
}
