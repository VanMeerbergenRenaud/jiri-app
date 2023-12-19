<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Auth;
use Illuminate\Http\RedirectResponse;

class ProjectsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all the events
        $events = $user->events;

        // Get all the projects
        $projects = $user->projects;

        return view('pages/projects', compact('user', 'events', 'projects'));
    }

    public function show($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('livewire/projects/show', compact('project'));
    }
}
