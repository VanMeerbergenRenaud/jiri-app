<?php

namespace App\Livewire\Evaluator;

use Livewire\Component;

class Dashboard extends Component
{
    public $events;
    public $contact;

    public function mount()
    {
        $this->contact = auth()->user()->contacts()
            ->findOrFail(request()->contact);

        // Get all the events of the contact where he is an evaluator only
        $this->events = auth()->user()->eventContacts()
            ->where('role', 'evaluator')
            ->where('contact_id', request()->contact)
            ->get();
    }

    public function render()
    {
        return view('livewire.evaluator.dashboard')
            ->layout('layouts.evaluator');
    }
}
