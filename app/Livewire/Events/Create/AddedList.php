<?php

namespace App\Livewire\Events\Create;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedList extends Component
{
    public int $eventId;

    public Collection $contactsList;

    public function mount() {

        $event = Event::find($this->eventId);

        $this->contactsList = $event->contacts;
    }

    #[On('fetchEventContacts')]
    public function fetchEventContacts()
    {
        $event = Event::find($this->eventId);

        $this->contactsList = $event->contacts;
    }

    public function removeContact($contactId)
    {
        $event = Event::find($this->eventId);

        $event->contacts()->detach($contactId);

        $this->dispatch('fetchEventContacts');
    }

    public function render()
    {
        return view('livewire.events.create.added-list');
    }
}
