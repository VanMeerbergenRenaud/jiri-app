<?php

namespace App\Livewire\Projects;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;

class ProjectRow extends Component
{
    public $project;

    public ProjectForm $form;

    public $showEditDialog = false;

    public $saved = false;

    public function mount()
    {
        $this->form->setProject($this->project);
    }

    public function save()
    {
        $this->form->update();
        $this->project->refresh();
        $this->reset('showEditDialog');
        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.projects.project-row');
    }
}
