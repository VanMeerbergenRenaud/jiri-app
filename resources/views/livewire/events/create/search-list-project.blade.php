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
                        <span class="capitalize projectName">{{ ucfirst($project->name) }}</span>
                        <div class="projectTasks">
                            @if(!empty($project->tasks))
                                <ul>
                                    @foreach($project->tasks as $task)
                                        <li>{{ ucfirst($task) }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span>Aucune tâche n'est associée à ce projet.</span>
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
