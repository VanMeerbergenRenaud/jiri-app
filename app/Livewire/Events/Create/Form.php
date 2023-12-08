<?php

namespace App\Livewire\Events\Create;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Form extends Component
{
    public int $eventId;

    #[Rule('required', 'min:3', 'type')]
    public $newcontacttype;

    #[Rule('required', 'min:3', 'name')]
    public $newcontactname;

    #[Rule('required', 'min:3', 'firstname')]
    public $newcontactfirstname;

    #[Rule('required', 'email', 'email')]
    public $newcontactemail;

    public function save(): void
    {
        $this->validate();

        $user = auth()->user();

        $user->contacts()->create([
            'role' => $this->newcontacttype,
            'name' => $this->newcontactname,
            'firstname' => $this->newcontactfirstname,
            'email' => $this->newcontactemail,
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.events.create.form');
    }
}
