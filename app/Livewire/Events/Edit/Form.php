<?php

namespace App\Livewire\Events\Edit;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Form extends Component
{
    public int $eventId;

    #[Validate('required')]
    public $newcontacttype;

    #[Validate('required|min:3')]
    public $newcontactname;

    #[Validate('required|min:3')]
    public $newcontactfirstname;

    #[Validate('required|email')]
    public $newcontactemail;

    public function save(): void
    {
        $this->validate();

        auth()->user()->contacts()->create([
            'name' => $this->newcontactname,
            'firstname' => $this->newcontactfirstname,
            'email' => $this->newcontactemail,
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.events.edit.form');
    }
}
