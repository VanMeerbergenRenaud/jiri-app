{{-- AddedList of contacts --}}
<div class="form__component__added">
    <p>Projets ajoutés</p>
    @if(count($projectsList) > 0)
        <ul>
            @foreach($projectsList as $project)
                <li wire:key="{{ $project->id }}">
                    <span class="category capitalize">{{ $project->name ?? 'Pas de nom' }}</span>
                    <span class="username capitalize">
                        @if(!empty($project->tasks))
                            @foreach(json_decode($project->tasks, true) as $task)
                                <span class="taskName">{{ ucfirst($task) }}</span>
                            @endforeach
                        @else
                            <span class="normal-case">Aucune tâche n'est associée à ce projet.</span>
                        @endif
                    </span>
                    <button type="button" class="button--white" wire:click="removeProject({{ $project->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer le projet '{{ $project->name }}' de l'épreuve ?">
                        @include('components.svg.trash2')
                    </button>
                </li>
            @endforeach
        </ul>
    @else
        <p class="no-contact">Aucun projets ajouté pour le moment.</p>
    @endif
</div>
