<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $contacts = auth()->user()->contacts()->get();

        return view('livewire.contacts.index', compact('contacts'))
            ->layout('layouts.app');
    }
}
