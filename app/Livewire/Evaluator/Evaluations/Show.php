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

        // These are the task related to a project in the event
        $this->tasks = $this->projects->first()->tasks;

        // This is the global comment of the evaluator
        $this->globalComment = auth()->user()->evaluatorGlobalComments()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->student->id)
            ->first()
            ->globalComment ?? null;

        // Timer -> somme de tous les timers des évaluations
        $this->timer = auth()->user()->evaluatorsEvaluations()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->evaluator->id)
            ->where('event_contact_id', $this->student->id)
            ->sum('timer');

        // Status
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

        auth()->user()->evaluatorGlobalComments()->updateOrCreate([
            'event_id' => $this->event->id,
            'contact_id' => $this->student->id,
        ], [
            'globalComment' => $this->globalComment,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->show = false;
    }

    protected function formatTimer($timer)
    {
        $hours = intval(substr($timer, 0, 2));
        $minutes = intval(substr($timer, 2, 2));
        $seconds = intval(substr($timer, 4, 2));

        if ($hours >= 24) {
            $days = intdiv($hours, 24);
            $hours = $hours % 24;
            $formattedTime = "{$days}j{$hours}h{$minutes}min";
        } else {
            $formattedTime = "{$hours}h{$minutes}min{$seconds}s";
        }

        return $formattedTime;
    }

    public function render()
    {
        return view('livewire.evaluator.evaluations.show')
            ->layout('layouts.evaluator');
    }
}
