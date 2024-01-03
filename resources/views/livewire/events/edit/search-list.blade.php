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
    <div x-data="{showSelectType: false, selectedContactId: null, selectedRole: null}">
        {{-- List of contacts --}}
        @unless($this->searchList->isEmpty())
            <ol class="filter__contacts__list">
                @foreach($this->searchList as $contact)
                    <li class="filter__contacts__list__item" wire:key="{{$contact->id}}">
                        <span class="capitalize name">{{ $contact->name }}</span>
                        <span class="capitalize">{{ $contact->firstname }}</span>
                        <span>{{ $contact->email }}</span>
                        <button type="button"
                                @click.stop="showSelectType = true;
                                selectedContactId = {{ $contact->id }};
                                selectedEventId = {{ $eventId }}">
                            Ajouter
                        </button>
                    </li>
                @endforeach
            </ol>
        @else
            <p class="no-contact">Aucun contact trouvé.</p>
        @endunless

        {{-- Modal to select the role of the contact --}}
        <template x-if="showSelectType">
            <div class="modal" @click="showSelectType = false">
                <div class="modal__dialog" @click.stop="showSelectType = true">
                    <p class="modal__title">
                        Quel type de contact souhaitez-vous ajouter ? <br>
                    </p>
                    {{-- Select to choose the type --}}
                    <div class="modal__select">
                        <label for="role"></label>
                        <select name="role" id="role" class="mb-6 p-3 bg-white" x-model="selectedRole">
                            <option>Choisissez un type</option>
                            <option value="student">Étudiant</option>
                            <option value="evaluator">Évaluateur</option>
                        </select>
                    </div>
                    <div class="modal__buttons">
                        <button class="cancel-button" @click="showSelectType = false">
                            Annuler
                        </button>
                        <button class="confirm-button"
                                @click.stop="showSelectType = false"
                                type="button"
                                wire:click="addContact(selectedContactId, selectedRole)">
                            Confirmer le choix
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
