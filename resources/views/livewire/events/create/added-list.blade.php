{{-- AddedList of contacts --}}
<div class="form__component__added">
    <p>Contacts ajoutés</p>
    @if(count($addedContacts) > 0)
        <ul>
            @foreach($addedContacts as $contact)
                <li wire:key="{{ $contact->id }}">
                    <span class="category">{{ $contact->category ?? 'Neutre' }}</span>
                    <span class="username">{{ $contact->name ?? 'Pas de nom' }}</span>
                    <button>
                        @include('components.svg.trash2')
                    </button>
                </li>
            @endforeach
        </ul>
    @else
        <p class="no-contact">Aucun contact ajouté pour le moment.</p>
    @endif
</div>
