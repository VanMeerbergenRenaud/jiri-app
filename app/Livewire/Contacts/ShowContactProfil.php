<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class ShowContactProfil extends Component
{
    public $contact;

    public $contactType;

    public function mount($contact)
    {
        $this->contact = $contact;

        $this->contactType = auth()->user()->attendances()->where('contact_id', $contact->id)->first()->role;
    }

    public function render()
    {
        return view('livewire.contacts.show-contact-profil');
    }
}
