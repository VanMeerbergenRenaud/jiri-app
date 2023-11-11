<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ContactList extends Component
{
    public $contactSearch = '';

    #[Computed]
    public function filteredContacts()
    {
        return $this->contactSearch
            ? Contact::where('name', 'like', '%' . $this->contactSearch . '%')
                ->orderBy('name', 'asc')->get()
            : new Collection();
    }

    public function render()
    {
        return view('livewire.contacts.contact-list');
    }
}
