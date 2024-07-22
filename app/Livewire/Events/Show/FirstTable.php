<?php

namespace App\Livewire\Events\Show;

use Livewire\Component;

class FirstTable extends Component
{
    public $event;

    public $contacts;

    public $students;

    public $evaluators;

    public function mount($event, $contacts, $students, $evaluators)
    {
        $this->event = $event;
        $this->contacts = $contacts;
        $this->students = $students;
        $this->evaluators = $evaluators;
    }

    public function getStatus($evaluatorId, $studentId)
    {
        $status = $this->event->evaluatorsEvaluations
            ->where('contact_id', $evaluatorId)
            ->where('event_contact_id', $studentId)
            ->first();

        return $status->status ?? null;
    }

    public function render()
    {
        return view('livewire.events.show.first-table');
    }
}
