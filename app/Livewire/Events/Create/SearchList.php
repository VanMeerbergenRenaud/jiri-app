<?php

namespace App\Livewire\Events\Create;

use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchList extends Component
{
    public $eventId;

    public $username = '';

    public $role; // student or evaluator

    #[Computed]
    public function searchList()
    {
        return $this->username
            ? Contact::where('name', 'like', '%'.$this->username.'%')->orderBy('name', 'asc')->get()
            : new Collection();
    }

    public function addContact($contactId, $role)
    {
        $event = Event::find($this->eventId);
        $contact = Contact::find($contactId);

        if (!$event->contacts()->where('contact_id', $contact->id)->exists()) {
            Attendance::create([
                'contact_id' => $contactId,
                'event_id' => $event->id,
                'role' => $role,
            ]);
        }

        $this->dispatch('fetchEventContacts');
    }

    public function render()
    {
        return view('livewire.events.create.search-list');
    }
}
