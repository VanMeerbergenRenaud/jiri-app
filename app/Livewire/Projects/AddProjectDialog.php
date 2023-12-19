<?php

namespace App\Livewire\Projects;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use Livewire\Component;

class AddProjectDialog extends Component
{
    public ProjectForm $form;

    public $show = false;

    public function add()
    {
        $this->form->save();

        $this->reset('show');

        $this->dispatch('added');
    }

    public function render()
    {
        $project = Project::find(1);
        return view('livewire.projects.add-project-dialog', ['project' => $project]);
    }
}
