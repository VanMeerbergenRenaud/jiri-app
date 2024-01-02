<?php

namespace App\Livewire\Events\Edit;

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
            ? auth()->user()->contacts()
                ->where('name', 'like', '%'.$this->username.'%')
                ->orderBy('name')
                ->get()
            : new Collection();
    }

    public function addContact($contactId, $role)
    {
        $event = Event::find($this->eventId);
        $contact = Contact::find($contactId);

        if (! $event->contacts()->where('contact_id', $contact->id)->exists()) {
            auth()->user()->attendances()->create([
                'event_id' => $event->id,
                'contact_id' => $contactId,
                'role' => $role,
            ]);
        }

        $this->dispatch('fetchEventContacts');
    }

    public function render()
    {
        return view('livewire.events.edit.search-list');
    }
}
