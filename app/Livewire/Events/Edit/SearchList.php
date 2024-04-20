<?php

namespace App\Livewire\Events\Edit;

use App\Models\EventContact;
use App\Models\Contact;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchList extends Component
{
    public $eventId;

    public $username = '';

    public $show = false;

    public $roles = [
        'student' => 'Étudiant',
        'evaluator' => 'Évaluateur',
        'neutre' => 'Neutre',
    ];

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
        $event = auth()->user()->events()->findOrFail($this->eventId);
        $contact = auth()->user()->contacts()->findOrFail($contactId);

        if (! $event->contacts()->where('contact_id', $contact->id)->exists()) {
            auth()->user()->eventContacts()->create([
                'event_id' => $event->id,
                'contact_id' => $contactId,
                'role' => $role,
            ]);
        }

        $this->reset('show');

        $this->dispatch('fetchEventContacts');
    }

    public function render()
    {
        return view('livewire.events.edit.search-list');
    }
}
