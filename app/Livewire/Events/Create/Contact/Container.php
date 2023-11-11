<?php

namespace App\Livewire\Events\Create\Contact;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Container extends Component
{
    public $contacts;

    #[Rule('required', 'min:3', 'max:255')]
    public $newcontacttype;

    #[Rule('required', 'min:3', 'max:255')]
    public $newcontactname;

    #[Rule('required', 'min:3', 'max:255')]
    public $newcontactlastname;

    #[Rule('required', 'email', 'unique:users,email')]
    public $newcontactemail;

    public function mount(): void
    {
        $this->contacts = collect();
    }

    public function save(): void
    {
        $this->validate([
            /*'newcontacttype' => 'required|min:3|max:255',*/
            'newcontactname' => 'required|min:3|max:255',
            'newcontactlastname' => 'required|min:3|max:255',
            'newcontactemail' => 'required|email|unique:users,email',
        ]);

        $renaud = User::whereEmail('renaud.vmb@gmail.com')->firstOrFail();

        $renaud->contacts()->create([
            'type' => $this->newcontacttype,
            'name' => $this->newcontactname,
            'lastname' => $this->newcontactlastname,
            'email' => $this->newcontactemail,
        ]);
    }

    public function render()
    {
        return view('livewire.events.create.contact.container');
    }
}
