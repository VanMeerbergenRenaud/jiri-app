{{-- SearchList of contacts --}}
<label for="username">
    <input
        type="text"
        id="username"
        wire:model.live="username"
        class="filter__contacts__input"
        placeholder="Chercher un contact"
    >
</label>
{{-- List of contacts --}}
@unless($contacts->isEmpty())
    <ol class="filter__contacts__list">
        @foreach($contacts as $contact)
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
