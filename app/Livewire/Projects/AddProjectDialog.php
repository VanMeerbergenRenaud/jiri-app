<?php

namespace App\Livewire\Projects;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;

class AddProjectDialog extends Component
{
    public ProjectForm $form;

    public $show = false;
    public $added = false;

    public function add()
    {
        $this->form->save();
        $this->reset('show');
        $this->added = true;
    }

    public function render()
    {
        return view('livewire.projects.add-project-dialog');
    }
}
