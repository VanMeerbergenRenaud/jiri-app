<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public $event;
    public $evaluator;
    public $token;
    public $student;

    public $tasks;
    public $project;
    public $projects;

    #[Validate('required')]
    public $timer;

    #[Validate('required')]
    public $status;

    #[Validate('required', 'numeric', 'min:0', 'max:20')]
    public $score;

    #[Validate('required', 'string', 'max:255')]
    public $comment;

    public function mount($event, $contact, $token, $student, $project)
    {
        $this->event = auth()->user()->events()->findOrFail($event);
        $this->evaluator = auth()->user()->contacts()->findOrFail($contact);
        $this->token = $token;
        $this->student = $this->event->contacts()->findOrFail($student);

        $this->projects = $this->event->projects;
        $this->project = $this->projects->first()->findOrFail($project);
        $this->tasks = $this->project->tasks;

        $evaluation = auth()->user()->evaluatorsEvaluations()
            ->where([
                'event_id' => $this->event->id,
                'contact_id' => $this->evaluator->id,
                'event_contact_id' => $this->student->id,
                'project_id' => $this->project->id,
            ])->first();

        $this->timer = $evaluation->timer ?? null;
        $this->status = $evaluation->status ?? 'null';
        $this->score = $evaluation->score ?? null;
        $this->comment = $evaluation->comment ?? null;
    }

    public function addEvaluation()
    {
        $this->validate([
            'timer' => 'required',
            'status' => 'required',
            'score' => 'required|numeric|min:0|max:20',
            'comment' => 'required|string|max:255',
        ]);

        auth()->user()->evaluatorsEvaluations()->updateOrCreate([
            // Unique combination to search for
            'event_id' => $this->event->id,
            'contact_id' => $this->evaluator->id,
            'event_contact_id' => $this->student->id,
            'project_id' => $this->project->id,
        ], [
            // Data to update or create with
            'score' => $this->score,
            'comment' => $this->comment,
            'status' => $this->status ?? 'not evaluated',
            'timer' => $this->timer,
            'public' => false,
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        return redirect()->route('events.evaluator-evaluation-summary', [
            'event' => $this->event->id,
            'contact' => $this->evaluator->id,
            'token' => $this->token,
            'student' => $this->student->id,
        ]);
    }

    public function render()
    {
        return view('livewire.evaluator.evaluations.edit')
            ->layout('layouts.evaluator');
    }
}
