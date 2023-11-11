{{-- AddedList contacts --}}
<div class="form__component__added">
    <p>Contacts ajoutés</p>
    @if(count($this->contacts) > 0)
        <ul>
            @foreach($this->contacts as $contact)
                <li wire:key="{{ $contact->id }}">
                    <span class="category">{{ $contact->category }}</span>
                    <span class="username">{{ $contact->name }}</span>
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
