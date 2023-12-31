<?php

namespace App\Livewire\Projects;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use Livewire\Component;

class AddProjectDialog extends Component
{
    public ProjectForm $form;

    public $show = false;

    public $allTasks;

    public function mount()
    {
        $this->allTasks = auth()->user()->tasks()->get();
    }

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
