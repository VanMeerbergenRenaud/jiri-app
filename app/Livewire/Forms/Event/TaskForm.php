<?php

namespace App\Livewire\Forms\Event;

use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    #[Validate('required|min:3|max:255')]
    public $name = '';

    public Task $task;

    public function setTask($task)
    {
        $this->task = $task;
        $this->name = $task->name;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->tasks()->create([
            'name' => $this->name,
        ]);

        $this->reset(['name']);
    }

    public function update()
    {
        $this->validate();

        $this->task->update([
            'name' => $this->name,
        ]);
    }
}
