<?php

namespace App\Livewire\Events\Edit;

use App\Models\Event;
use App\Models\EventContact;
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
        $event = auth()->user()->events()->find($this->eventId);
        $this->eventContactsList = $event->eventContacts;
    }

    public function removeContact(EventContact $eventContacts)
    {
        $eventContacts->delete();

        $this->dispatch('fetchEventContacts');
    }

    public function exchangeRole($eventContactId)
    {
        $eventContact = auth()->user()->events()->find($this->eventId)->eventContacts()->find($eventContactId);

        $eventContact->role = $eventContact->role === 'student' ? 'evaluator' : 'student';

        $eventContact->save();

        $this->dispatch('fetchEventContacts');
    }

    public function render()
    {
        $students = $this->eventContactsList->filter(function ($eventContact) {
            return $eventContact->role == 'student';
        });
        $evaluators = $this->eventContactsList->filter(function ($eventContact) {
            return $eventContact->role == 'evaluator';
        });

        $roleTranslations = [
            'student' => 'étudiant',
            'evaluator' => 'évaluateur',
        ];
        return view('livewire.events.edit.added-list', compact('students', 'evaluators', 'roleTranslations'));
    }
}
