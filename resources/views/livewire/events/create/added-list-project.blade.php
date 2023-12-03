{{-- AddedList of contacts --}}
<div class="form__component__added">
    <p>Projets ajoutés</p>
    @if(count($dutiesList) > 0)
        <ul>
            @foreach($dutiesList as $duty)
                <li wire:key="{{ $duty->id }}">
                    <span class="category capitalize">{{ $duty->name ?? 'Pas de nom' }}</span>
                    <span class="username capitalize">{{ $duty->tasks ?? 'Pas de tâches' }}</span>
                    <button type="button" wire:click="removeContact({{ $duty->id }})">
                        @include('components.svg.trash2')
                    </button>
                </li>
            @endforeach
        </ul>
    @else
        <p class="no-contact">Aucun projets ajouté pour le moment.</p>
    @endif
</div>
