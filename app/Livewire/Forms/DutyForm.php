<?php

namespace App\Livewire\Forms;

use App\Models\Duty;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DutyForm extends Form
{
    #[Validate('required|min:3')]
    public $name = '';

    public Duty $duty;

    public function setDuty($duty)
    {
        $this->duty = $duty;
        $this->name = $duty->name;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->duties()->create([
            'name' => $this->name,
        ]);

        $this->reset(['name']);
    }

    public function update()
    {
        $this->validate();

        $this->duty->update([
            'name' => $this->name,
        ]);
    }
}
