<?php

namespace App\Livewire\Events\Create;

use App\Models\Contact;
use App\Models\Event;
use Livewire\Component;

class AddedList extends Component
{
    public $addContact = [];

    public function addContact($contactId, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $contact = Contact::findOrFail($contactId);

        if ($event->contacts->contains($contact)) {
        $event->contacts()->attach($contact->id);

        $this->addContact[] = $contact;

        // TODO : dispatch method to update the list of contacts

        }
    }

    public function render()
    {
        return view('livewire.events.create.added-list');
    }
}
