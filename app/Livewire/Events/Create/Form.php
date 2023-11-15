<?php

namespace App\Livewire\Events\Create;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Form extends Component
{
    #[Rule('required')]
    public $newcontacttype;

    #[Rule('required', 'min:3', 'max:255')]
    public $newcontactname;

    #[Rule('required', 'min:3', 'max:255')]
    public $newcontactlastname;

    #[Rule('required', 'email', 'unique:users,email')]
    public $newcontactemail;

    public function save(): void
    {
        $this->validate();

        $renaud = User::whereEmail('renaud.vmb@gmail.com')
            ->firstOrFail();
        $renaud->contacts()->create([
            'type' => $this->newcontacttype,
            'name' => $this->newcontactname,
            'lastname' => $this->newcontactlastname,
            'email' => $this->newcontactemail,
        ]);
    }

    public function render()
    {
        return view('livewire.events.create.form');
    }
}
