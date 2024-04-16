<div>
    {{-- SearchList of contacts --}}
    <x-form.field
        label="Nom d'utilisateur"
        name="username"
        type="text"
        class="filter__contacts__input"
        placeholder="Chercher un contact à ajouter"
        :messages="$errors->get('username')"
        srOnly="true"
        wire:model.live="username"
    />
    <div x-data="{showSelectType: false, selectedContactId: null, selectedRole: null}">
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
                                            selectedEventId = {{ $eventId }}"
                                >
                                    Ajouter
                                </button>
                            </x-dialog.open>

                            <x-dialog.panel>
                                <form class="form">
                                    <div class="form__content">
                                        <h2 class="title">Quel type de contact souhaitez-vous ajouter ?</h2>

                                        <label for="role">Veuillez choisir un type ci-dessous</label>
                                        <select name="role" id="role" x-model="selectedRole">
                                            <option>Choisissez un type</option>
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
</div>
