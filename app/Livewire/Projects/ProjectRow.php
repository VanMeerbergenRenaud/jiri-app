<?php

namespace App\Livewire\Projects;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;

class ProjectRow extends Component
{
    public $project;

    public $allTasks;
    public $tasks = [];

    public ProjectForm $form;

    public $showEditDialog = false;

    public function mount()
    {
        $this->form->setProject($this->project);

        $this->allTasks = auth()->user()->tasks()->get();

        $this->tasks = $this->project->tasks;
    }

    public function save()
    {
        $this->form->update();

        $this->project->refresh();

        $this->reset('showEditDialog');
    }

    public function render()
    {
        return view('livewire.projects.project-row');
    }
}
