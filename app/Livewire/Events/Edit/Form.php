<?php

namespace App\Livewire\Events\Edit;

use App\Models\Contact;
use App\Models\EventContact;
use Illuminate\Support\Str;
use Livewire\Component;

/*
    It is a form that allows the user to select a role
    for the contact (student or evaluator) and add the new contact to the event.
*/
class Form extends Component
{
    public $name;
    public $firstname;
    public $email;
    public $role = 'student';

    public $saved = false;

    public $eventId;

    public function mount()
    {
        $this->eventId = request()->route('event');
    }

    public function addContactToEvent()
    {
        // Validate the form data
        $this->validate([
            'name' => 'required|min:3',
            'firstname' => 'required|min:3',
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
            'event_id' => $this->eventId,
            'role' => $this->role,
            'token' =>  Str::random(64),
        ]);

        // Reset the form fields
        $this->reset(['name', 'firstname', 'email', 'role']);

        $this->dispatch('fetchEventContacts');

        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.events.edit.form');
    }
}
