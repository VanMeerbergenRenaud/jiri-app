<?php

namespace App\Livewire\Events;

use Livewire\Component;

class EvaluatorDashboard extends Component
{
    public $eventId;
    public $contactId;
    public $tokenValue;

    public function mount($event, $contact, $token)
    {
        $this->eventId = $event;
        $this->contactId = $contact;
        $this->tokenValue = $token;
    }

    public function render()
    {
        $user = auth()->user();
        $event = $user->events()->findOrFail($this->eventId);
        $contact = $event->contacts()->findOrFail($this->contactId);

        $evaluator = $user->eventContacts()
            ->where('event_id', $this->eventId)
            ->where('token', $this->tokenValue)
            ->firstOrFail();

        return view('livewire.events.evaluator-dashboard', compact('user', 'event', 'contact', 'evaluator'))
            ->layout('layouts.evaluator')
            ->title($event->name);
    }
}
