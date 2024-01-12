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

    public $allTasks;

    public $selectedTasks = [];

    public function mount()
    {
        $this->allTasks = auth()->user()->tasks()->get();
    }

    public function addSelectedTask(Task $task)
    {
        $this->selectedTasks[] = $task;
    }

    public function add()
    {
        $this->form->selectedTasks = $this->selectedTasks;

        $this->form->save();

        $this->reset('show');
    }

    public function render()
    {
        return view('livewire.projects.add-project-dialog');
    }
}
