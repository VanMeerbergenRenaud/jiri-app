<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class Index extends Component
{
    public $contacts;

    public function mount()
    {
        $this->contacts = auth()->user()->contacts;
    }

    public function render()
    {
        return view('livewire.contacts.index')
            ->layout('layouts.app');
    }
}
