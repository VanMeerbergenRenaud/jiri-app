<?php

namespace App\Livewire\Events\Create;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use App\Models\Contact;
use Livewire\Component;

class SearchList extends Component
{
    public $username = '';
    public $addedContact = [];

    #[Computed]
    public function searchList() {
        return $this->username
            ? Contact::where('name', 'like', '%' . $this->username . '%')->orderBy('name', 'asc')->get()
            : new Collection();
    }

    public function addContact($contactId, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $contact = Contact::findOrFail($contactId);

        $event->contacts()->attach($contact->id);

        $this->addedContact[] = $contact;

        // TODO : dispatch method to update the list of contacts
         $this->dispatch('updateAddedList', $contact->id);
    }

    public function render()
    {
        return view('livewire.events.create.search-list');
    }
}
