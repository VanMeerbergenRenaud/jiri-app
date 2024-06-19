<?php

namespace App\Livewire\Evaluator;

use Livewire\Component;

class Header extends Component
{
    public $contact;

    public function mount()
    {
        $this->contact = auth()->user()->contacts()->findOrFail(request()->contact);
    }

    public function render()
    {
        return view('livewire.evaluator.header');
    }
}
