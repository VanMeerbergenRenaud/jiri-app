<div>
    {{-- SearchList of contacts --}}
    <label for="username">
        <input
            type="text"
            id="username"
            wire:model.live="username"
            class="filter__contacts__input"
            placeholder="Chercher un contact à ajouter"
        >
    </label>
    {{-- List of contacts --}}
    @unless($this->searchList->isEmpty())
        <ol class="filter__contacts__list">
            @foreach($this->searchList as $contact)
                <li class="filter__contacts__list__item" wire:key="{{$contact->id}}">
                    <span>{{ $contact->name }}</span>
                    <span>{{ $contact->lastname }}</span>
                    <span>{{ $contact->email }}</span>
                    <button type="button" wire:click="addContact({{ $contact->id }})">Ajouter</button>
                    {{-- TODO : Ajouter une boite modal qui permet de sélectionner le role du contact lorsque l'on clic sur le bouton Ajouter --}}
                </li>
            @endforeach
        </ol>
    @else
        <p class="no-contact">Aucun contact trouvé.</p>
    @endunless
</div>
