<?php

namespace App\Livewire\Events\Create;

use App\Models\Contact;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchList extends Component
{
    public int $eventId;

    public $username = '';

    #[Computed]
    public function searchList() {
        return $this->username
            ? Contact::where('name', 'like', '%' . $this->username . '%')->orderBy('name', 'asc')->get()
            : new Collection();
    }

    public function addContact(Contact $contact)
    {
        $event = Event::find($this->eventId);

        if (!$event->contacts()->where('contact_id', $contact->id)->exists()) {
            $event->contacts()->attach($contact->id);
        }

        $this->dispatch('fetchEventContacts');
    }


    public function render()
    {
        return view('livewire.events.create.search-list');
    }
}
