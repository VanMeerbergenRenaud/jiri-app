<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Component;

// Permet de voir le résumé des évaluations
// sur tous les projets évalués par l'évaluateur
class Show extends Component
{
    public $event;
    public $contact;
    public $token;

    public $projects;
    public $tasks;

    public function mount($event, $contact, $token)
    {
        $this->event = auth()->user()->events()
            ->findOrFail($event);
        $this->contact = auth()->user()->contacts()
            ->findOrFail($contact);

        $this->token = $token;

        $this->projects = $this->event->projects;

        // These are the task related to a project in the event
        $this->tasks = $this->projects
            ->first()
            ->tasks;
    }

    public function render()
    {
        return view('livewire.evaluator.evaluations.show')
            ->layout('layouts.evaluator');
    }
}
