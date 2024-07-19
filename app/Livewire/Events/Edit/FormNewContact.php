<?php

namespace App\Livewire\Events\Edit;

use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

/*
    It is a form that allows the user to select a role
    for the contact (student or evaluator) and add the new contact to the event.
*/
class FormNewContact extends Component
{
    public $event;
    public $newContact = false;

    #[Validate('required|min:3|max:50')]
    public $name;

    #[Validate('required|min:3|max:50')]
    public $firstname;

    #[Validate('email|nullable')]
    public $email;

    #[Validate('required|in:student,evaluator')]
    public $role = 'student';

    public function mount($event)
    {
        $this->event = $event;
    }

    public function addContactToEvent()
    {
        // Validate the form data
        $this->validate([
            'name' => 'required|min:3|max:50',
            'firstname' => 'required|min:3|max:50',
            'email' => 'email|nullable',
            'role' => 'required|in:student,evaluator',
        ]);

        // Create a new contact
        $contact = auth()->user()->contacts()->create([
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
        ]);

        // Create a new event contact with a random token
        auth()->user()->eventContacts()->create([
            'contact_id' => $contact->id,
            'event_id' => $this->event->id,
            'role' => $this->role,
            'token' => Str::random(64),
        ]);

        // Reset the form fields
        $this->reset(['name', 'firstname', 'email', 'role']);

        $this->dispatch('fetchEventContacts');

        $this->newContact = true;
    }

    public function render()
    {
        return view('livewire.events.edit.form-new-contact');
    }
}
