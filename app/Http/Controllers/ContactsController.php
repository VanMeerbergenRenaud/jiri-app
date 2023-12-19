<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Auth;
use Illuminate\Http\RedirectResponse;

class ContactsController
{
    public function index()
    {
        $user = Auth::user();

        $contacts = $user->contacts()->get();

        $students = $contacts->where('role', 'student');
        $evaluators = $contacts->where('role', 'evaluator');

        return view('pages/contacts', ['contacts' => $contacts, 'students' => $students, 'evaluators' => $evaluators, 'user' => $user]);
    }

    public function show($contactId)
    {
        $contact = Contact::findOrFail($contactId);

        return view('livewire/contacts/show', compact('contact'));
    }
}
