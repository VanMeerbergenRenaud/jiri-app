<?php

namespace App\Livewire\Forms\Event;

use App\Models\EventContact;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventContactsForm extends Form
{
    public EventContact $eventContacts;

    #[Validate('required|min:3')]
    public $role = '';

    #[Validate('required|min:3')]
    public $token = '';

    public function setEventContacts($eventContacts)
    {
        $this->eventContacts = $eventContacts;
        $this->role = $eventContacts->role;
        $this->token = $eventContacts->token;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->eventContacts()->create([
            'role' => $this->role,
            'token' => $this->token,
        ]);

        $this->reset(['role', 'token']);
    }

    public function update()
    {
        $this->validate();

        $this->eventContacts->update([
            'role' => $this->role,
            'token' => $this->token,
        ]);
    }
}
