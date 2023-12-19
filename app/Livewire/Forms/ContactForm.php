<?php

namespace App\Livewire\Forms;

use App\Models\Contact;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|min:3')]
    public $firstname = '';

    #[Validate('email|nullable')]
    public $email = null;

    public Contact $contact;

    public function setContact($contact)
    {
        $this->contact = $contact;
        $this->name = $contact->name;
        $this->firstname = $contact->firstname;
        $this->email = $contact->email;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->contacts()->create([
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
        ]);

        $this->reset(['name', 'firstname', 'email']);
    }

    public function update()
    {
        $this->validate();

        $this->contact->update([
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
        ]);
    }
}
