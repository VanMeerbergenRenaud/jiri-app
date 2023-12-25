<?php

namespace App\Livewire\Evaluator;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $event;

    public $projects;

    public function mount()
    {
        $this->event = auth()->user()->events()->first();

        $this->projects = auth()->user()->events()
            ->join('duties', 'events.id', '=', 'duties.event_id')
            ->join('projects', 'duties.project_id', '=', 'projects.id')
            ->where('events.id', $this->event->id)
            ->get();
    }

    #[Computed]
    public function studentFilter()
    {
        return auth()->user()->attendances()
            ->join('contacts', 'attendances.contact_id', '=', 'contacts.id')
            ->where('event_id', $this->event->id)
            ->where('role', 'student')
            ->where('contacts.name', 'like', '%'.$this->search.'%')
            ->orderBy('contacts.'.$this->sortField, $this->sortDirection)
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
        return view('livewire.evaluator.dashboard', [
            'sortField' => $this->sortField,
        ]);
    }
}
