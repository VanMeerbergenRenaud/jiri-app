<div>
    {{-- SearchList of contacts --}}
    <x-form.field
        label="Nom d'utilisateur"
        name="username"
        type="text"
        class="filter__contacts__input"
        placeholder="Chercher un contact à ajouter"
        srOnly="true"
        model="username"
        wire:model.live="username"
    />
    <div x-data="{showSelectType: false, selectedContactId: null, selectedRole: 'student'}">
        {{-- List of contacts --}}
        @unless($this->searchList->isEmpty())
            <ol class="filter__contacts__list">
                @foreach($this->searchList as $contact)
                    <li class="filter__contacts__list__item" wire:key="{{$contact->id}}">
                        <span class="capitalize name">{{ $contact->name }}</span>
                        <span class="capitalize">{{ $contact->firstname }}</span>
                        <span>{{ $contact->email }}</span>

                        <x-dialog>
                            <x-dialog.open>
                                <button type="button"
                                        @click="
                                            selectedContactId = {{ $contact->id }};
                                            selectedEventId = {{ $event }}"
                                >
                                    Ajouter
                                </button>
                            </x-dialog.open>

                            <x-dialog.panel>
                                <form class="form" wire:submit.prevent="addContact(selectedContactId, selectedRole)">
                                    <div class="form__content">
                                        <h2 class="title">Quel type de contact souhaitez-vous ajouter&nbsp;?</h2>

                                        <label for="role">
                                            Veuillez choisir un type ci-dessous pour <strong class="bold">{{ $contact->name }}&nbsp;:</strong>
                                        </label>
                                        <select name="role" id="role" x-model="selectedRole">
                                            <option disabled selected value="">Choisissez un type</option>
                                            <option value="student">Étudiant</option>
                                            <option value="evaluator">Évaluateur</option>
                                        </select>
                                    </div>

                                    <x-dialog.footer>
                                        <x-dialog.close>
                                            <button type="button" class="cancel">
                                                Annuler
                                            </button>
                                        </x-dialog.close>

                                        <button type="submit" class="save" wire:click="addContact(selectedContactId, selectedRole)">
                                            Confirmer le choix
                                        </button>
                                    </x-dialog.footer>
                                </form>
                            </x-dialog.panel>
                        </x-dialog>
                    </li>
                @endforeach
            </ol>
        @else
            <p class="no-contact">Aucun contact trouvé.</p>
        @endunless
    </div>

    @if($added)
        <x-notifications
            icon="add"
            title="Contact ajouté à l'épreuve !"
            method="$set('added', false)"
        />
    @endif
</div>
