<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Auth;
use Request;

class ContactsController
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        $contacts = $this->user->contacts()->whereIn('role', ['student', 'evaluator'])->get();

        $students = $contacts->where('role', 'student');
        $evaluators = $contacts->where('role', 'evaluator');

        return view('livewire.pages/contacts', ['user' => $this->user, 'contacts' => $contacts, 'students' => $students, 'evaluators' => $evaluators]);
    }

    public function create()
    {
        return view('livewire/contacts/create', ['user' => $this->user]);
    }

    public function show($contactId)
    {
        $contact = Contact::findOrFail($contactId);
        return view('livewire/contacts/show', ['user' => $this->user, 'contact' => $contact]);
    }

    public function edit($contactId)
    {
        $contact = Contact::findOrFail($contactId);
        return view('livewire/contacts/edit', ['user' => $this->user, 'contact' => $contact]);
    }

    public function update($contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $contact->update(Request::only('name', 'email'));
        return redirect()->route('contacts.index', ['contact' => $contact, 'user' => $this->user]);
    }

    public function store()
    {
        $contact = $this->user->contacts()->create();
        $contact->update(Request::only('name', 'email'));
        return redirect()->route('contacts.index', ['contact' => $contact, 'user' => $this->user]);
    }

    public function destroy($contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $contact->delete();
        return redirect()->route('contacts.index', ['contact' => $contact, 'user' => $this->user]);
    }
}
