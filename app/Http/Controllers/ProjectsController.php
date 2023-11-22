<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Project;
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

        return view('livewire.pages/projects', compact('user', 'events', 'projects'));
    }

    public function create()
    {
        $project = new Project();
        return view('livewire/project/create', compact('project'));
    }

    public function show($projectId)
    {
        $project = Project::findOrFail($projectId);
        return view('livewire/project/show', compact('project'));
    }

    public function edit($projectId)
    {
        $project = Project::find($projectId);

        return view('livewire/project/edit', compact('project'));
    }

    public function store() : RedirectResponse
    {
        $data = $this->validateProjectData();

        auth()->user()?->projects()->create($data);

        return redirect('projects');
    }

    public function update($projectId)
    {
        $data = $this->validateProjectData();

        $project = Project::findOrFail($projectId);

        $project->update($data);

        return redirect('projects');
    }

    public function destroy($projectId)
    {
        $project = Project::findOrFail($projectId);

        $project->delete();

        return redirect('projects');
    }

    private function validateProjectData()
    {
        return request()->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);
    }
}
