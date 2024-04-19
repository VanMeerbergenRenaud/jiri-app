<?php

namespace App\Livewire\Forms;

use App\Models\EventProject;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventProjectForm extends Form
{
    public EventProject $eventProject;

    #[Validate('numeric|min:1|max:100')]
    public $ponderation = 1;

    #[Validate('url|nullable')]
    public $link = 'https://example.com';

    public function setEventProject($eventProject)
    {
        $this->eventProject = $eventProject;
        $this->ponderation = $eventProject->ponderation;
        $this->link = $eventProject->link;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->eventProjects()->create([
            'ponderation' => $this->ponderation,
            'link' => $this->link,
        ]);

        $this->reset(['ponderation', 'link']);
    }

    public function update()
    {
        $this->validate();

        $this->eventProject->update([
            'ponderation' => $this->ponderation,
            'link' => $this->link,
        ]);
    }
}
