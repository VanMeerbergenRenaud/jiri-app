<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class Show extends Component
{
    public $contactId;

    public function mount($contact)
    {
        $this->contactId = $contact;
    }

    public function render()
    {
        $user = auth()->user();

        $contact = $user->contacts()->findOrFail($this->contactId);

        return view('livewire.contacts.show', compact('user', 'contact'))
            ->layout('layouts.app');
    }
}
