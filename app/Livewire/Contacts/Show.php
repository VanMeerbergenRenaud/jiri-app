<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class Show extends Component
{
    public $contact;

    public $contacts;

    public function mount($contact)
    {
        $this->contacts = auth()->user()->contacts;
        $this->contact = auth()->user()->contacts()
            ->with(['eventContacts.event', 'eventContacts.contact'])
            ->findOrFail($contact);
    }

    public function redirectUser($contactId)
    {
        return redirect()->route('contacts.show', ['contact' => $contactId]);
    }

    public function render()
    {
        return view('livewire.contacts.show')
            ->layout('layouts.app');
    }
}
