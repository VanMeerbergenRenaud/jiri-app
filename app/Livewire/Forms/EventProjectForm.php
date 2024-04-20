<?php

namespace App\Livewire\Forms;

use App\Models\EventProject;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventProjectForm extends Form
{
    public EventProject $eventProject;

    #[Validate('numeric|min:1|max:100')]
    public $ponderation1 = 1;

    #[Validate('numeric|min:1|max:100')]
    public $ponderation2 = 1;

    #[Validate('url|nullable')]
    public $link = 'https://example.com';

    public function setEventProject($eventProject)
    {
        $this->eventProject = $eventProject;
        $this->ponderation1 = $eventProject->ponderation1;
        $this->ponderation2 = $eventProject->ponderation2;
        $this->link = $eventProject->link;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->eventProjects()->create([
            'ponderation1' => $this->ponderation1,
            'ponderation2' => $this->ponderation2,
            'link' => $this->link,
        ]);

        $this->reset(['ponderation1', 'ponderation2', 'link']);
    }

    public function update()
    {
        $this->validate();

        $this->eventProject->update([
            'ponderation1' => $this->ponderation1,
            'ponderation2' => $this->ponderation2,
            'link' => $this->link,
        ]);
    }
}
