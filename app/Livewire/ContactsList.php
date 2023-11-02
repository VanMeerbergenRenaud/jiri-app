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
    public $newcontactname;

    #[Rule('required', 'email', 'unique:users,email')]
    public $newcontactemail;

    #[Computed]
    public function contacts()
    {
        return $this->contactname
            ? Contact::where('name', 'like', '%' . $this->contactname . '%')
                ->orderBy('name', 'asc')
                ->get()
            : new Collection();
    }

    public function save()
    {
        $dominique = User::whereEmail('dominique.vilain@hepl.be')
            ->firstOrFail();
        $dominique->contacts()->create([
            'name' => $this->newcontactname,
            'email' => $this->newcontactemail,
        ]);
    }
}
