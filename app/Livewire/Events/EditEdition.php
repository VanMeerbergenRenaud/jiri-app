<?php

namespace App\Livewire\Events;

use Livewire\Component;

class EditEdition extends Component
{
    public function render()
    {
        return view('livewire.events.edit-edition', [
            'students' => $this->students,
        ]);
    }

    public function addStudentRow()
    {
        $this->students[] = [
            'lastname' => '',
            'firstname' => '',
            'photo' => '',
            'projects' => '',
            'categories' => '',
            'show' => true,
        ];
    }
}

