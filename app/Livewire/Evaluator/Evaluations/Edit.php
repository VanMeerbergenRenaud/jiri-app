<?php

namespace App\Livewire\Evaluator\Evaluations;

use Carbon\Carbon;
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

    #[Validate('required|string|in:not evaluated,pending,evaluated')]
    public $status;

    #[Validate('required|numeric|min:0|max:20')]
    public $score;

    #[Validate('required|string|max:255')]
    public $comment;

    // Timer properties
    public $timer;

    public $elapsedSeconds = 0;

    public $hours = '00';

    public $minutes = '00';

    public $seconds = '00';

    public $timerStopped = false;

    public function mount($event, $contact, $token, $student, $project)
    {
        $this->event = auth()->user()->events()->findOrFail($event);
        $this->evaluator = auth()->user()->contacts()->findOrFail($contact);
        $this->token = $token;
        $this->student = $this->event->contacts()->findOrFail($student);

        $this->projects = $this->event->projects;
        $this->project = $this->projects->first()->findOrFail($project);
        $this->tasks = $this->project->tasks;

        $evaluation = auth()->user()->evaluatorsEvaluations()->firstOrNew([
            'event_id' => $this->event->id,
            'contact_id' => $this->evaluator->id,
            'event_contact_id' => $this->student->id,
            'project_id' => $this->project->id,
        ]);

        $this->timer = $evaluation->timer ?? null;
        $this->status = $evaluation->status ?? 'not evaluated';
        $this->score = $evaluation->score ?? '0';
        $this->comment = $evaluation->comment ?? null;

        if ($this->timer) {
            $this->elapsedSeconds = Carbon::parse($this->timer)->diffInSeconds(Carbon::parse('00:00:00'));
            $this->timerStopped = true;
        }

        $this->updateTimer();
    }

    public function updateTimer()
    {
        if (! $this->timerStopped) {
            $this->elapsedSeconds++;
            $this->updateTimeDisplay();
        }
    }

    public function endTimer()
    {
        $this->timerStopped = true;
        $this->updateTimeDisplay();
        $this->timer = "{$this->hours}:{$this->minutes}:{$this->seconds}";
    }

    public function addEvaluation()
    {
        $this->validate();

        if ($this->status === 'evaluated') {
            $this->endTimer();
        }

        auth()->user()->evaluatorsEvaluations()->updateOrCreate([
            'event_id' => $this->event->id,
            'contact_id' => $this->evaluator->id,
            'event_contact_id' => $this->student->id,
            'project_id' => $this->project->id,
        ], [
            'score' => $this->score,
            'comment' => $this->comment,
            'status' => $this->status,
            'timer' => $this->timer,
        ]);

        return redirect()->route('events.evaluator-evaluation-summary', [
            'event' => $this->event->id,
            'contact' => $this->evaluator->id,
            'token' => $this->token,
            'student' => $this->student->id,
        ]);
    }

    private function updateTimeDisplay()
    {
        $this->hours = str_pad(floor($this->elapsedSeconds / 3600), 2, '0', STR_PAD_LEFT);
        $this->minutes = str_pad(floor(($this->elapsedSeconds % 3600) / 60), 2, '0', STR_PAD_LEFT);
        $this->seconds = str_pad($this->elapsedSeconds % 60, 2, '0', STR_PAD_LEFT);
    }

    public function render()
    {
        return view('livewire.evaluator.evaluations.edit')
            ->layout('layouts.evaluator');
    }
}
