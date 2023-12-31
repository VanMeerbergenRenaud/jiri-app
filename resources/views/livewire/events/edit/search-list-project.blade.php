<div>
    {{-- SearchList of projects --}}
    <label for="projectname">
        <input
            type="text"
            id="projectname"
            wire:model.live="projectname"
            class="filter__contacts__input"
            placeholder="Chercher un projet à ajouter"
        >
    </label>
    <div x-data="{showSelectType: false, selectedProjectId: null}">
        {{-- List of projects --}}
        @unless($this->searchList->isEmpty())
            <ol class="filter__contacts__list">
                @foreach($this->searchList as $project)
                    <li class="filter__contacts__list__item" wire:key="{{$project->id}}">
                        <span class="capitalize name projectName">{{ ucfirst($project->name) }}</span>
                        <div class="projectTasks">
                            @if($project->tasks->count())
                                <span>
                                    @foreach($project->tasks as $task)
                                        <span class="taskName">{{ ucfirst($task->name) }}</span>
                                    @endforeach
                                </span>
                            @else
                                <span class="underline">
                                    Aucune tâche associée à ce projet.
                                </span>
                            @endif
                        </div>
                        <button type="button" wire:click="addDuty({{ $project->id }})">
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
