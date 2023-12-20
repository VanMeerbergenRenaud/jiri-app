<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Auth;
use Illuminate\Http\RedirectResponse;

class ContactsController
{
    public function index()
    {
        $user = auth()->user();

        $contacts = $user->contacts()->get();

        return view('pages/contacts', compact('user', 'contacts'));
    }

    public function show($contactId)
    {
        $contact = Contact::findOrFail($contactId);

        return view('pages/contacts/show', compact('contact'));
    }
}
