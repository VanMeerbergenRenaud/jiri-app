<?php

namespace App\Livewire\Projects;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;

class ProjectRow extends Component
{
    public $project;

    public $tasks;

    public ProjectForm $form;

    public $showEditDialog = false;

    public function mount()
    {
        $this->form->setProject($this->project);
        $this->tasks = json_encode(auth()->user()->projects->pluck('tasks'));
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
