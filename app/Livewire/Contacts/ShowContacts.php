<?php

namespace App\Livewire\Contacts;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ShowContacts extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $deleted = false;

    #[Computed]
    public function contactFilter()
    {
        return auth()->user()->contacts()
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('firstname', 'like', '%'.$this->search.'%');
            })
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
        $contact = auth()->user()->contacts()->findOrFail($contactId);

        $contact->eventContacts()->delete();
        $contact->delete();

        sleep(1);

        $this->deleted = true;
    }

    public function render()
    {
        return view('livewire.contacts.show-contacts', [
            'sortField' => $this->sortField,
        ]);
    }
}
