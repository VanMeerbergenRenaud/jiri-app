<?php

namespace App\Livewire\Events\Create;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedList extends Component
{
    public $eventId;

    public Collection $contactsList;

    public $tasks;

    public function mount() {
        $event = Event::find($this->eventId);
        $this->contactsList = $event ? $event->contacts : new Collection();
        $this->tasks = $this->getUniqueTasks();
    }

    public function getUniqueTasks()
    {
        return $this->contactsList->flatMap(function ($contact) {
            return json_decode($contact->tasks);
        })->unique();
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
