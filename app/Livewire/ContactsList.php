<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ContactsList extends Component
{
    public $contactname = '';

    #[Rule('required', 'min:3', 'max:255')]
    public $newcontacttype;

    #[Rule('required', 'min:3', 'max:255')]
    public $newcontactname;

    #[Rule('required', 'min:3', 'max:255')]
    public $newcontactlastname;

    #[Rule('required', 'email', 'unique:users,email')]
    public $newcontactemail;

    public $saved = false; // To show the confirmation message

    #[Computed]
    public function contacts()
    {
        return $this->contactname
            ? Contact::where('name', 'like', '%' . $this->contactname . '%')
                ->orderBy('name', 'asc')->get()
            : new Collection();
    }

    public function save()
    {
        $this->validate([
            /*'newcontacttype' => 'required|min:3|max:255',*/
            'newcontactname' => 'required|min:3|max:255',
            'newcontactlastname' => 'required|min:3|max:255',
            'newcontactemail' => 'required|email|unique:users,email',
        ]);

        $renaud = User::whereEmail('renaud.vmb@gmail.com')
            ->firstOrFail();
        $renaud->contacts()->create([
            'type' => $this->newcontacttype,
            'name' => $this->newcontactname,
            'lastname' => $this->newcontactlastname,
            'email' => $this->newcontactemail,
        ]);

        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.contacts.contacts-list');
    }
}
