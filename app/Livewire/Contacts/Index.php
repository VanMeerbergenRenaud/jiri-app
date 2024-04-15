<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $user = auth()->user();

        $contacts = $user->contacts()->get();

        return view('livewire.contacts.index', compact('user', 'contacts'))
            ->layout('layouts.app');
    }
}
