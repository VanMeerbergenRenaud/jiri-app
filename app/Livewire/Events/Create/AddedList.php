<?php

namespace App\Livewire\Events\Create;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedList extends Component
{
    public int $eventId = 5;
    public Collection $contactsList;

    public function mount() {
        $this->contactsList = new Collection();
    }

    #[On('eventContacts')]
    public function eventContacts()
    {
        $event = Event::find($this->eventId);

        $this->contactsList = $event->contacts;
    }

    public function removeContact($contactId)
    {
        $event = Event::find($this->eventId);

        $event->contacts()->detach($contactId);

        $this->dispatch('eventContacts');
    }

    public function render()
    {
        return view('livewire.events.create.added-list');
    }
}
