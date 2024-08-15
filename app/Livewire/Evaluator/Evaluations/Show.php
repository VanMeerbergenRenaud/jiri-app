<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Attributes\Validate;
use Livewire\Component;

// Permet de voir le résumé des évaluations
// sur tous les projets évalués par l'évaluateur
class Show extends Component
{
    public $event;

    public $evaluator;

    public $token;

    public $student;

    public $projects;

    public $tasks;

    #[Validate('required', 'string', 'max:255')]
    public $globalComment;

    public $info;

    public $timer;

    public $show = false;

    public function mount($event, $contact, $token, $student)
    {
        $this->event = auth()->user()->events()->findOrFail($event);
        $this->evaluator = auth()->user()->contacts()->findOrFail($contact);
        $this->token = $token;
        $this->student = $this->event->contacts()->findOrFail($student);

        $this->projects = $this->event->projects;

        $this->tasks = $this->projects->first()->tasks;

        $this->globalComment = auth()->user()->evaluatorGlobalComments()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->evaluator->id)
            ->where('event_contact_id', $this->student->id)
            ->first()
            ->globalComment ?? null;

        // Status, score, comment, timer
        $this->info = auth()->user()->evaluatorsEvaluations()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->evaluator->id)
            ->where('event_contact_id', $this->student->id)
            ->get();
    }

    public function updateGlobalComment()
    {
        $this->validate([
            'globalComment' => 'required|string|max:255',
        ]);

        auth()->user()->evaluatorGlobalComments()
            ->updateOrCreate([
                'event_id' => $this->event->id,
                'contact_id' => $this->evaluator->id,
                'event_contact_id' => $this->student->id,
            ], [
                'globalComment' => $this->globalComment,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $this->show = false;
    }

    public function render()
    {
        return view('livewire.evaluator.evaluations.show')
            ->layout('layouts.evaluator');
    }
}
