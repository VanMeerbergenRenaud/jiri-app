<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class ContactProfil extends Component
{
    public $eventId;
    public $contactId;

    public function mount($event, $contact)
    {
        $this->eventId = $event;
        $this->contactId = $contact;
    }

    public function redirectUser($contactId)
    {
        return redirect()->route('events.contact-profil', ['event' => $this->eventId, 'contact' => $contactId]);
    }

    public function render()
    {
        $event = auth()->user()->events()->findOrFail($this->eventId);
        $contact = $event->contacts()->findOrFail($this->contactId);

        return view('livewire.contacts.contact-profil', compact('event', 'contact'))
            ->layout('layouts.app');
    }
}
