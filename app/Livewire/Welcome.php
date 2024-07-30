<?php

namespace App\Livewire;

use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        $user = auth()->user();

        $avatar = $user->github_avatar ?? asset('img/default-avatar.png');

        return view('livewire.welcome', compact('user', 'avatar'))
            ->layout('layouts.home');
    }
}
