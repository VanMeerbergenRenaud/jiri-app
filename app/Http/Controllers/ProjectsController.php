<?php

namespace App\Http\Controllers;

use Auth;

class ProjectsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('livewire.pages/projects', compact('user'));
    }
}
