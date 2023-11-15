<?php

namespace App\Livewire\Events\Create;

use Livewire\Component;

class AddedList extends Component
{
    public $addedContacts = [];

    public function updateAddedList($contactId)
    {
        $this->addedContacts[] = $contactId;
    }

    public function render()
    {
        return view('livewire.events.create.added-list');
    }
}
