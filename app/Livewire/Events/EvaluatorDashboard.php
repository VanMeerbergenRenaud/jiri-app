<?php

namespace App\Livewire\Events;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluatorDashboard extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $event;

    public $projects;
    public $students;

    public $evaluator;
    public $contactId;

    public function mount()
    {
        $this->event = auth()->user()->events()->findOrFail(request()->event);
        $this->contactId = request()->contact_id;

        $this->projects = $this->event->projects;
        $this->students = $this->event->students;



        // Find the evaluator contact
        $this->evaluator = $this->event->contacts()->findOrFail($this->contactId);
    }

    #[Computed]
    public function studentFilter()
    {
        return auth()->user()->eventContacts()
            ->join('contacts', 'event_contact.contact_id', '=', 'contacts.id')
            ->where('event_id', $this->event->id)
            ->where('role', 'student')
            ->where('contacts.name', 'like', '%' . $this->search . '%')
            ->orderBy('contacts.' . $this->sortField, $this->sortDirection)
            ->paginate(8);
    }

    // TODO : update filter for visibility, activity_time, projects, evaluations and gradesStatus
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.events.evaluator-dashboard', ['sortField' => $this->sortField])
            ->layout('layouts.evaluator', ['title' => 'Tableau de bord']);
    }
}
