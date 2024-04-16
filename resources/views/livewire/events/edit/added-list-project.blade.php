{{-- AddedList of contacts --}}
<div class="form__component__added">
    <p>Projets ajoutés</p>
    @if(count($dutiesList) > 0)
        <ul>
            @foreach($dutiesList as $duty)
                <li wire:key="{{ $duty->id }}">
                    <span class="category capitalize">{{ $duty->name ?? 'Pas de nom' }}</span>
                    {{--<span class="username capitalize">
                        @if($duty->tasks->count())
                            @foreach($duty->tasks as $task)
                                <span class="taskName">{{ ucfirst($task->name) }}</span>
                            @endforeach
                        @else
                            <span class="normal-case">Aucune tâche n'est associée à ce projet.</span>
                        @endif
                    </span>--}}
                    <button type="button" class="button--white" wire:click="removeContact({{ $duty->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer le projet '{{ $duty->name }}' de l'épreuve ?">
                        @include('components.svg.trash2')
                    </button>
                </li>
            @endforeach
        </ul>
    @else
        <p class="no-contact">Aucun projets ajouté pour le moment.</p>
    @endif
</div>
