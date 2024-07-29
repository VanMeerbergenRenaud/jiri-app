<?php

namespace App\Livewire\Events\Show;

use Livewire\Component;

class FirstTable extends Component
{
    public $event;

    public $contacts;

    public $students;

    public $evaluators;

    public $status = [];

    public function mount($event, $contacts, $students, $evaluators)
    {
        $this->event = $event;
        $this->contacts = $contacts;
        $this->students = $students;
        $this->evaluators = $evaluators;

        foreach ($students as $student) {
            foreach ($evaluators as $evaluator) {
                $evaluation = $this->event->evaluatorsEvaluationsStatuses()
                    ->where([
                        'event_id' => $this->event->id,
                        'contact_id' => $evaluator->contact->id,
                        'event_contact_id' => $student->contact->id,
                    ])->first();

                $this->status[$student->contact->id][$evaluator->contact->id] = $evaluation->status ?? 'not evaluated';
            }
        }
    }

    public function updateStatus($studentId, $evaluatorId)
    {
        $value = $this->status[$studentId][$evaluatorId];

        $this->validate([
            "status.$studentId.$evaluatorId" => 'required|in:not evaluated,pending,evaluated',
        ]);

        $this->event->evaluatorsEvaluationsStatuses()
            ->updateOrCreate(
                [
                    'event_id' => $this->event->id,
                    'contact_id' => $evaluatorId,
                    'event_contact_id' => $studentId,
                ],
                [
                    'status' => $value,
                    'public' => true,
                ]
            );
    }

    public function render()
    {
        return view('livewire.events.show.first-table');
    }
}
