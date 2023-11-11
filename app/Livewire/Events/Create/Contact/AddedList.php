<?php

namespace App\Livewire\Events\Create\Contact;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddedList extends Component
{
    #[Computed]
    public function contacts(): Collection
    {
        return Contact::all();
    }

    public function render()
    {
        return view('livewire.events.create.contact.added-list');
    }
}
