<?php

namespace App\Livewire\Events\Edit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchList extends Component
{
    public $eventId;

    public $username = '';

    public $show = false;

    public $added = false;

    public $roles = [
        'student' => 'Étudiant',
        'evaluator' => 'Évaluateur',
    ];

    #[Computed]
    public function searchList()
    {
        $event = auth()->user()->events()->findOrFail($this->eventId);
        $existingContactIds = $event->contacts()->pluck('contacts.id');

        return $this->username
            ? auth()->user()->contacts()
                ->where('name', 'like', '%' . $this->username . '%')
                ->whereNotIn('id', $existingContactIds)
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
                'token' => Str::random(64),
            ]);
        }

        $this->reset('show');

        $this->dispatch('fetchEventContacts');

        $this->added = true;
    }

    public function render()
    {
        return view('livewire.events.edit.search-list');
    }
}
