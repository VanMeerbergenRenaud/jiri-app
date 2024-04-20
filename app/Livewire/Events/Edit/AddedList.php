<?php

namespace App\Livewire\Events\Edit;

use App\Models\EventContact;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedList extends Component
{
    public $eventId;

    public Collection $eventContactsList;

    public function mount()
    {
        $this->fetchEventContacts();
    }

    #[On('fetchEventContacts')]
    public function fetchEventContacts()
    {
        $event = Event::find($this->eventId);
        $this->eventContactsList = $event->eventContacts;
    }

    public function removeContact(EventContact $eventContacts)
    {
        $eventContacts->delete();

        $this->dispatch('fetchEventContacts');
    }

    public function render()
    {
        return view('livewire.events.edit.added-list');
    }
}
