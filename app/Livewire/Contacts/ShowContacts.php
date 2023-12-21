<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ShowContacts extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'name';
    public $sortDirection = 'asc';

    // protected $queryString = ['sortField', 'sortDirection', 'perPage'];

    public $saved = false;

    #[Computed]
    public function contactFilter()
    {
        return auth()->user()->contacts()
            ->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(8);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function delete($contactId)
    {
        $contact = Contact::findOrFail($contactId);

        $contact->events()->detach();
        $contact->projects()->detach();
        $contact->delete();

        sleep(1);

        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.contacts.show-contacts', [
            'saved' => $this->saved,
            'sortField' => $this->sortField,
        ]);
    }
}
