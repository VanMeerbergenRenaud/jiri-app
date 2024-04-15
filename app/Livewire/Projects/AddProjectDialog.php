<?php

namespace App\Livewire\Projects;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use App\Models\Task;
use Livewire\Component;

class AddProjectDialog extends Component
{
    public ProjectForm $form;

    public $show = false;

    public function add()
    {
        $this->form->save();

        $this->reset('show');
    }

    public function render()
    {
        return view('livewire.projects.add-project-dialog');
    }
}
