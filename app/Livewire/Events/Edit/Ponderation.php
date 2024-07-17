<?php

namespace App\Livewire\Events\Edit;

use App\Models\ProjectPonderation;
use Livewire\Component;

class Ponderation extends Component
{
    public ProjectPonderation $projectPonderation;

    public $event;
    public $ponderations = [];

    public $totalPercentage = 100;
    public $remainingPercentage = 100;

    public $ponderationOfProjects;
    public $ponderation1;
    public $ponderation2;

    public function mount($event)
    {
        $this->event = $event;

        // Ponderation of projects
        $this->ponderationOfProjects = auth()->user()->projectPonderations()
            ->where('event_id', $this->event->id)
            ->get();

        // Initialization of the ponderations
        foreach ($this->ponderationOfProjects as $projectPonderation) {
            $this->ponderations[$projectPonderation->project_id] = [
                'ponderation1' => $projectPonderation->ponderation1,
                'ponderation2' => $projectPonderation->ponderation2,
            ];
        }
    }

    public function save()
    {
        // Multiple fields validation
        $this->validate([
            'ponderations.*.ponderation1' => 'required|numeric|min:1|max:100',
            'ponderations.*.ponderation2' => 'required|numeric|min:1|max:100',
        ]);

        foreach ($this->ponderationOfProjects as $projectPonderation) {
            $projectId = $projectPonderation->project_id;

            auth()->user()->projectPonderations()->updateOrCreate([
                    'event_id' => $this->event->id,
                    'project_id' => $projectId,
                ], [
                    'ponderation1' => $this->ponderations[$projectId]['ponderation1'],
                    'ponderation2' => $this->ponderations[$projectId]['ponderation2'],
                ]
            );
        }

        return redirect()->route('events.edit', $this->event);
    }

    public function render()
    {
        return view('livewire.events.edit.ponderation');
    }
}
