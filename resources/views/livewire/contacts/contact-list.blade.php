<div class="filter__contacts">

    {{-- Search input --}}
    <label for="contactSearch">
        <input
            type="text"
            id="contactSearch"
            wire:model.live="contactSearch"
            class="filter__contacts__input"
            placeholder="Chercher un contact"
        >
    </label>

    {{-- List of contacts --}}
    @unless($this->filteredContacts->isEmpty())
        <ol class="filter__contacts__list">
            @foreach($this->filteredContacts as $contact)
                <li wire:key="{{ $contact->id }}" class="filter__contacts__list__item">
                    <span>{{ $contact->name }}</span>
                    <span>{{ $contact->lastname }}</span>
                    <span>{{ $contact->email }}</span>
                    <button id="user{{$contact->id}}">Ajouter</button>
                </li>
            @endforeach
        </ol>
    @else
        <p class="no-contact">Aucun contact trouvé.</p>
    @endunless
</div>
