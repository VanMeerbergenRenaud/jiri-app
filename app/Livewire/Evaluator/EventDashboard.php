<?php

namespace App\Livewire\Evaluator;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class EventDashboard extends Component
{
    use WithPagination;

    public $search = '';

    public $sortDirection = 'asc';

    public $event;

    public $evaluator;

    public $token;

    public $students;

    public $projects;

    public function mount($event, $contact, $token)
    {
        $this->event = auth()->user()->events()->findOrFail($event);
        $this->evaluator = auth()->user()->contacts()->findOrFail($contact);
        $this->token = $token;

        $this->projects = $this->event->projects;
        $this->students = $this->event->students;
    }

    #[Computed]
    public function studentFilter()
    {
        return auth()->user()->eventContacts()
            ->join('contacts', 'event_contact.contact_id', 'contacts.id')
            ->where('event_id', $this->event->id)
            ->where('role', 'student')
            ->where('contacts.name', 'like', '%'.$this->search.'%')
            ->orderBy('contacts.name', $this->sortDirection)
            ->paginate(8);
    }

    // Toggle between asc and desc
    public function sortByDirection()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        return view('livewire.evaluator.event-dashboard')
            ->layout('layouts.evaluator');
    }
}
