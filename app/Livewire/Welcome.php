<?php

namespace App\Livewire;

use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        $user = auth()->user();

        return view('livewire.welcome', compact('user'))
            ->layout('layouts.home', ['title' => 'Welcome']);
    }
}
