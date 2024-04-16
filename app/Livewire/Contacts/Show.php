<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class Show extends Component
{
    public $contactId;

    public $contacts;

    public function mount($contact)
    {
        $this->contactId = $contact;
        $this->contacts = auth()->user()->contacts;
    }

    public function redirectUser($contactId)
    {
        return redirect()->route('contacts.show', ['contact' => $contactId]);
    }

    public function render()
    {
        $user = auth()->user();

        $contact = $user->contacts()->findOrFail($this->contactId);

        return view('livewire.contacts.show', compact('user', 'contact'))
            ->layout('layouts.app');
    }
}
