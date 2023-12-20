<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Auth;
use Illuminate\Http\RedirectResponse;

class ProjectsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $projects = $user->projects();

        return view('pages/projects', compact('user', 'projects'));
    }

    public function show($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('livewire/projects/show', compact('project'));
    }
}
