<?php

namespace App\Livewire\Events\Configure;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Form extends Component
{
    public int $eventId;

    #[Validate('required')]
    public $newcontacttype;

    #[Validate('required')]
    public $newcontactname;

    #[Validate('required')]
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

        // create the attendance as well
        /*auth()->user()->attendances()->create([
            'event_id' => $this->eventId,
            'role' => $this->newcontacttype,
            'name' => $this->newcontactname,
            'firstname' => $this->newcontactfirstname,
            'email' => $this->newcontactemail,
        ]);*/

        $this->reset();
    }

    public function render()
    {
        return view('livewire.events.configure.form');
    }
}
