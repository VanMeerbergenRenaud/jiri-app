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
    public $contactType;

    public ContactForm $form;

    public $projects;
    public $evaluators;
    public $students;
    public $evaluationOfEachEvaluatorForStudent;
    public $evaluationOfEvaluatorForEachStudent;

    #[Validate('nullable|max:1000')]
    public $globalComment;

    public $showEditDialog = false;

    public function mount($contact)
    {
        $this->contact = $contact;
        $this->form->setContact($this->contact);

        $this->contactType = auth()->user()->eventContacts()
            ->where('event_id', $this->contact->pivot->event_id)
            ->where('contact_id', $contact->id)
            ->first()
            ->role;

       $this->projects = auth()->user()->projectPonderations()
            ->with('project')
            ->where('event_id', $this->contact->pivot->event_id)
            ->get();

        // Get the global comment of the contact
        $this->globalComment = auth()->user()->eventGlobalComments()
            ->where('event_id', $this->contact->pivot->event_id)
            ->where('contact_id', $this->contact->id)
            ->first()
        ->globalComment;

        /*
         * Get the evaluators and students of the event
        */
        $this->evaluators = auth()->user()->eventContacts()
            ->where('event_id', $this->contact->pivot->event_id)
            ->where('role', 'evaluator')
            ->get();

        $this->students = auth()->user()->eventContacts()
            ->where('event_id', $this->contact->pivot->event_id)
            ->where('role', 'student')
            ->get();

        /*
         * Get the evaluations of all the evaluators that evaluated the student (student profil)
        */
        $this->evaluationOfEachEvaluatorForStudent = auth()->user()->evaluatorsEvaluations()
            ->where('event_id', $this->contact->pivot->event_id)
            //->where('event_contact_id', $this->contact->id)// // the evaluators
            ->where('contact_id', $this->contact->id)// the student evaluated
            //->where('status', 'evaluated')
            ->get();

        /*
         * Get the evaluations from an evaluator to all the student he evaluates (evaluator profil)
        */
        $this->evaluationOfEvaluatorForEachStudent = auth()->user()->evaluatorsEvaluations()
            ->where('event_id', $this->contact->pivot->event_id)
            //->where('contact_id', ?)// several contacts (students) evaluated by the same evaluator
            ->where('event_contact_id', $this->contact->id) // the evaluator
            //->where('status', 'evaluated')
            ->get();

        //dd($this->evaluationOfEvaluatorForEachStudent);
    }

    public function saveContact()
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

    public function editContactRole()
    {
        dd('need to change the role of the contact');
    }

    public function render()
    {
        return view('livewire.contacts.show-contact-profil');
    }
}
