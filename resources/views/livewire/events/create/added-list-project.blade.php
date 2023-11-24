{{-- AddedList of contacts --}}
<div class="form__component__added">
    <p>Projets ajoutés</p>
    @if(count($projectsList) > 0)
        <ul>
            @foreach($projectsList as $project)
                <li wire:key="{{ $project->id }}">
                    <span class="username capitalize">{{ $project->name ?? 'Pas de nom' }}</span>
                    <span class="username capitalize">{{ $project->tasks ?? 'Pas de catégorie' }}</span>
                    <button type="button" wire:click="removeContact({{ $project->id }})">
                        @include('components.svg.trash2')
                    </button>
                </li>
            @endforeach
        </ul>
    @else
        <p class="no-contact">Aucun projets ajouté pour le moment.</p>
    @endif
</div>
