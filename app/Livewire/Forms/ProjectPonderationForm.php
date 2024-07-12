<?php

namespace App\Livewire\Forms;

use App\Models\ProjectPonderation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjectPonderationForm extends Form
{
    public ProjectPonderation $projectPonderation;

    #[Validate('numeric|min:1|max:100')]
    public $ponderation1 = 1;

    #[Validate('numeric|min:1|max:100')]
    public $ponderation2 = 1;

    public function setEventProject($eventProject)
    {
        $this->projectPonderation = $eventProject;
        $this->ponderation1 = $eventProject->ponderation1;
        $this->ponderation2 = $eventProject->ponderation2;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->projectPonderation()->create([
            'ponderation1' => $this->ponderation1,
            'ponderation2' => $this->ponderation2,
        ]);

        $this->reset(['ponderation1', 'ponderation2']);
    }

    public function update()
    {
        $this->validate();

        $this->projectPonderation->update([
            'ponderation1' => $this->ponderation1,
            'ponderation2' => $this->ponderation2,
        ]);
    }
}
