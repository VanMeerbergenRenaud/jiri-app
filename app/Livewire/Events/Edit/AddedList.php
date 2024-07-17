<?php

namespace App\Livewire\Events\Edit;

use App\Models\EventContact;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedList extends Component
{
    public $event;

    public Collection $eventContactsList;

    public function mount($event)
    {
        $this->event = $event;
        $this->fetchEventContacts();
    }

    #[On('fetchEventContacts')]
    public function fetchEventContacts()
    {
        $this->eventContactsList = $this->event->eventContacts;
    }

    public function removeContact(EventContact $eventContact)
    {
        $eventContact->delete();

        $this->dispatch('fetchEventContacts');
    }

    public function exchangeRole(EventContact $eventContact)
    {
        $eventContact->role = ($eventContact->role === 'student') ? 'evaluator' : 'student';

        $eventContact->save();

        $this->fetchEventContacts();
    }

    public function render()
    {
        return view('livewire.events.edit.added-list');
    }
}
