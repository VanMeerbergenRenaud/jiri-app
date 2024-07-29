<?php

namespace App\Livewire\Evaluator;

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

    public $projects;

    public function mount($event, $contact, $token)
    {
        $this->event = auth()->user()->events()->findOrFail($event);
        $this->evaluator = auth()->user()->contacts()->findOrFail($contact);
        $this->token = $token;

        $this->projects = $this->event->projects;
    }

    // Toggle between asc and desc
    public function sortByDirection()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        $students = auth()->user()->eventContacts()
            ->join('contacts', 'event_contact.contact_id', 'contacts.id')
            ->with('contact')
            ->where('event_id', $this->event->id)
            ->where('role', 'student')
            ->where('contacts.name', 'like', '%'.$this->search.'%')
            ->orderBy('contacts.name', $this->sortDirection)
            ->paginate(8);

        $evaluations = auth()->user()->evaluatorsEvaluations()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->evaluator->id)
            ->get()
            ->groupBy('event_contact_id');

        return view('livewire.evaluator.event-dashboard', compact('students', 'evaluations'))
            ->layout('layouts.evaluator');
    }
}
