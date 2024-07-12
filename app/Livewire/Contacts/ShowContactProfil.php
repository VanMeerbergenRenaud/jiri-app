<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowContactProfil extends Component
{
    use WithFileUploads;

    public $contact;

    public ContactForm $form;

    public $showEditDialog = false;

    // Other properties
    public $projects;

    public $contactType;

    public $evaluators;

    public $evaluation;

    #[Validate('nullable|max:1000')]
    public $globalComment;

    public function mount($contact)
    {
        $this->contact = $contact;
        $this->form->setContact($this->contact);

        $this->contactType = auth()->user()->eventContacts()
            ->where('event_id', $this->contact->pivot->event_id)
            ->where('contact_id', $contact->id)
            ->first()
            ->role;

        $this->projects = auth()->user()->projectPonderation()
            ->where('event_id', $this->contact->pivot->event_id)
            ->get();

        // Get the global comment of the contact
        $this->globalComment = auth()->user()->eventGlobalComment()
            ->where('event_id', $this->contact->pivot->event_id)
            ->where('contact_id', $this->contact->id)
            ->first()
        ->globalComment;

        // Get all the evaluators of the event that rated the contact
        $this->evaluators = auth()->user()->eventContacts()
            ->where('event_id', $this->contact->pivot->event_id)
            ->where('role', 'evaluator')
            ->get();

        // Get the evaluation of the contact from the evaluatorsEvaluation table (project, event and contact id)
        $this->evaluation = auth()->user()->evaluatorsEvaluation()
            ->where('event_id', $this->contact->pivot->event_id)
            ->where('contact_id', $this->contact->id)
            ->get();
    }

    public function save()
    {
        $this->form->update();

        $this->contact->refresh();

        $this->reset('showEditDialog');
    }

    public function saveGlobalComment()
    {
        $this->validate();

        dd('need to save the global comment of the contact');
    }

    // TODO : Change the role of the contact by updating its role in the attendances table (evaluator or student)
    public function editContactRole($role) {}

    public function render()
    {
        return view('livewire.contacts.show-contact-profil');
    }
}
