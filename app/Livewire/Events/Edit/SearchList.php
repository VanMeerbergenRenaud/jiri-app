<?php

namespace App\Livewire\Events\Edit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchList extends Component
{
    public $event;
    public $username = '';

    public $show = false;
    public $added = false;

    public function mount($event)
    {
        $this->event = $event;
    }

    #[Computed]
    public function searchList()
    {
        $existingContactIds = $this->event->contacts->pluck('id');

        return $this->username
            ? auth()->user()->contacts()
                ->where('name', 'like', '%'.$this->username.'%')
                ->whereNotIn('id', $existingContactIds)
                ->orderBy('name')
                ->get()
            : new Collection();
    }

    public function addContact($contactId, $role)
    {
        $contact = auth()->user()->contacts()->findOrFail($contactId);

        if (! $this->event->contacts()->where('contact_id', $contact->id)->exists()) {
            auth()->user()->eventContacts()->create([
                'event_id' => $this->event->id,
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
