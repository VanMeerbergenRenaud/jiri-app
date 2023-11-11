<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all the events
        $events = $user->events;

        // Get all the projects
        $projects = $user->projects;

        return view('livewire.pages/projects', compact('user', 'events', 'projects'));
    }
}
