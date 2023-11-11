<?php

namespace App\Livewire\Events\Create;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use App\Models\Contact;
use Livewire\Component;

class SearchList extends Component
{
    // contact
    public $contacts;
    public $username = '';

    #[Computed]
    public function searchList() {
        return $this->username
            ? Contact::where('name', 'like', '%' . $this->username . '%')->orderBy('name', 'asc')->get()
            : new Collection();
    }

    public function render()
    {
        return view('livewire.events.create.search-list');
    }
}
