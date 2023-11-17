<?php

namespace App\Http\Controllers;

/*use App\Models\Contact;
use Illuminate\Http\Request;*/

class StudentController extends Controller
{
    public function index()
    {
        return view('student');
    }

    /*public function show($id)
    {
        $student = Contact::findOrFail($id);

        return view('student', ['student' => $student]);
    }

    public function edit($id)
    {
        $student = Contact::findOrFail($id);

        return view('student', ['student' => $student]);
    }

    public function update(Request $request, $id)
    {
        $student = Contact::findOrFail($id);

        $student->update($request->all());

        return redirect()->route('student.show', ['student' => $student]);
    }*/
}
