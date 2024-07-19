<?php

namespace App\Livewire\Events\Edit;

use Livewire\Attributes\On;
use Livewire\Component;

class Ponderation extends Component
{
    public $event;

    public $ponderationOfProjects;

    public $ponderation1 = 1;
    public $ponderation2 = 1;
    public $ponderations = [];

    public $savePonderation = false;

    public function mount($event)
    {
        $this->event = $event;

        // Ponderation of projects
        $this->fetchEventProjects();

        // Initialization of the ponderations
        foreach ($this->ponderationOfProjects as $projectPonderation) {
            $this->ponderations[$projectPonderation->project_id] = [
                'ponderation1' => $projectPonderation->ponderation1,
                'ponderation2' => $projectPonderation->ponderation2,
            ];
        }
    }

    #[On('fetchEventProjects')]
    public function fetchEventProjects()
    {
        $this->ponderationOfProjects = auth()->user()->projectPonderations()
            ->where('event_id', $this->event->id)
            ->get();
    }

    private function validateTotalPercentage()
    {
        // The ponderation of each event must be equal to 100% for the sum of ponderation1 or ponderation2
        $expectedTotal = 100;

        $totalPonderation1 = 0;
        $totalPonderation2 = 0;

        foreach ($this->ponderations as $ponderations) {
            $totalPonderation1 += $ponderations['ponderation1'];
            $totalPonderation2 += $ponderations['ponderation2'];
        }

        // If the two ponderations are incorrect
        if ($totalPonderation1 !== $expectedTotal && $totalPonderation2 !== $expectedTotal) {
            $this->addError('ponderation1', "⚠︎ La somme totale des pondérations pour le projets doit être égale à $expectedTotal%. Votre somme est de $totalPonderation1% pour la pondération 1.");
            $this->addError('ponderation2', "⚠︎ La somme totale des pondérations pour le projets doit être égale à $expectedTotal%. Votre somme est de $totalPonderation2% pour la pondération 2.");
            return false;
        }

        // If only the ponderation 1 is incorrect
        if ($totalPonderation1 !== $expectedTotal) {
            $this->addError('ponderation1', "⚠︎ La somme totale des pondérations pour le ou les divers projets doit être égale à $expectedTotal%. Votre somme est de $totalPonderation1% pour la pondération 1.");
            return false;
        }

        // If only the ponderation 2 is incorrect
        if ($totalPonderation2 !== $expectedTotal) {
            $this->addError('ponderation2', "⚠︎ La somme totale des pondérations pour le ou les divers projets doit être égale à $expectedTotal%. Votre somme est de $totalPonderation2% pour la pondération 2.");
            return false;
        }

        // Otherwise, the total percentage is correct
        return true;
    }

    public function save()
    {
        // Multiple fields validation
        $this->validate([
            'ponderations.*.ponderation1' => 'required|numeric|min:1|max:100',
            'ponderations.*.ponderation2' => 'required|numeric|min:1|max:100',
        ]);

        // Total percentage validation
        if (!$this->validateTotalPercentage()) {
            return false;
        }

        // Update the new ponderation of each project
        foreach ($this->ponderationOfProjects as $projectPonderation) {
            $projectId = $projectPonderation->project_id;

            auth()->user()->projectPonderations()->updateOrCreate([
                    'event_id' => $this->event->id,
                    'project_id' => $projectId,
                ], [
                    'ponderation1' => $this->ponderations[$projectId]['ponderation1'] ?? 1,
                    'ponderation2' => $this->ponderations[$projectId]['ponderation2'] ?? 1,
                ]
            );
        }

        return redirect()->route('events.index');
    }

    public function render()
    {
        return view('livewire.events.edit.ponderation');
    }
}
