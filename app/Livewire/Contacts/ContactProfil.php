<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class ContactProfil extends Component
{
    public $event;
    public $contact;

    public function mount($event, $contact)
    {
        $this->event = auth()->user()->events()->findOrFail($event);
        $this->contact = $this->event->contacts()->findOrFail($contact);
    }

    public function redirectUser($contactId)
    {
        return redirect()->route('events.contact-profil', [
            'event' => $this->event->id,
            'contact' => $contactId
        ]);
    }

    public function render()
    {
        return view('livewire.contacts.contact-profil')
            ->layout('layouts.app');
    }
}
