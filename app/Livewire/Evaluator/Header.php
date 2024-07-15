<?php

namespace App\Livewire\Evaluator;

use Livewire\Component;

class Header extends Component
{
    public $event;
    public $evaluator;

    public function mount($event, $evaluator)
    {
        $this->event = $event;
        $this->evaluator = $evaluator;
    }

    public function render()
    {
        return view('livewire.evaluator.header');
    }
}
