<div>
    <x-form.field
        label="Nom d'utilisateur"
        name="projectname"
        type="text"
        class="filter__contacts__input"
        placeholder="Chercher un projet à ajouter"
        :messages="$errors->get('projectname')"
        srOnly="true"
        model="projectname"
        wire:model.live="projectname"
    />
    <div x-data="{showSelectType: false, selectedProjectId: null}">
        {{-- List of projects --}}
        @unless($this->searchList->isEmpty())
            <ol class="filter__contacts__list">
                @foreach($this->searchList as $project)
                    <li class="filter__contacts__list__item" wire:key="{{$project->id}}">
                        <span class="capitalize name projectName">{{ ucfirst($project->name) }}</span>
                        <div class="projectTasks">
                            @if(!empty($project->tasks))
                                @foreach(json_decode($project->tasks, true) as $task)
                                    <span class="taskName">{{ ucfirst($task) }}</span>
                                @endforeach
                            @else
                                <span class="underline">
                                    Aucune tâche associée à ce projet.
                                </span>
                            @endif
                        </div>
                        <button type="button" wire:click="addProject({{ $project->id }})">
                            Ajouter
                        </button>
                    </li>
                @endforeach
            </ol>
        @else
            <p class="no-contact">Aucun project trouvé.</p>
        @endunless
    </div>
</div>
