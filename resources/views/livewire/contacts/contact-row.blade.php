<tr>
    <td class="name">
        <a href="{{ route('contacts.show', $contact) }}" title="Voir le profil de {{ $contact->name }}">
            @if($contact->avatar)
                <img src="{{ asset($contact->avatar) . '?' . $contact->updated_at->format("U") }}" alt="photo de profil du contact">
            @else
                <img src="{{ asset('img/placeholder.png') }}" alt="Image du contact">
            @endif
            {{ ucwords($contact->name) }}
        </a>
    </td>
    <td class="firstname">{{ ucwords($contact->firstname) }}</td>
    <td class="email">{{ $contact->email }}</td>
    <td class="actions">
        <x-menu>
            <x-menu.button>
                <x-svg.dots/>
            </x-menu.button>

            <x-menu.items>
                {{-- Item to show a contact --}}
                <a class="link" href="{{ route('contacts.show', $contact) }}">
                    <x-svg.show/>

                    Voir
                </a>

                <x-divider />

                {{-- Dialog to edit a contact --}}
                <x-dialog wire:model="showEditDialog">
                    <x-dialog.open>
                        <x-menu.close>
                            <x-menu.item>
                                <x-svg.edit/>

                                Modifier
                            </x-menu.item>
                        </x-menu.close>
                    </x-dialog.open>

                    <x-dialog.panel>
                        <x-contact.editForm :contact="$contact" :form="$form" />
                    </x-dialog.panel>
                </x-dialog>

                <x-divider />

                {{-- Dialog to suppress a contact--}}
                <x-dialog>
                    <x-dialog.open>
                        <x-menu.close>
                            <x-menu.item>
                                <x-svg.trash/>

                                Supprimer
                            </x-menu.item>
                        </x-menu.close>
                    </x-dialog.open>

                    <x-dialog.panel>
                        <div x-data="{ confirmation: '' }">
                            <div class="panel__delete">
                                <div class="advertising">
                                    <x-svg.advertising/>
                                    <div class="advertising__content">
                                        <h3 role="heading" aria-level="3" class="title">Supprimer le contact</h3>
                                        <p class="description">
                                            Êtes-vous sûre de vouloir supprimer le contact
                                            <span class="font-semibold"> {{ $contact->name }} {{ $contact->firstname }}</span>&nbsp;? Toutes les données seront supprimées. Cette action est irréversible.
                                        </p>
                                        <label class="confirm-deletion">
                                            Veuillez tapper "CONFIRMER" pour confirmer la suppression.
                                            <input x-model="confirmation" placeholder="CONFIRMER">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <x-dialog.footer>
                                <x-dialog.close>
                                    <button type="button" class="cancel">Annuler</button>
                                </x-dialog.close>

                                <x-dialog.close>
                                    <button
                                        type="button"
                                        class="delete"
                                        :disabled="confirmation !== 'CONFIRMER'"
                                        wire:click="$dispatch('deleted')"
                                    >
                                        Supprimer
                                    </button>
                                </x-dialog.close>
                            </x-dialog.footer>
                        </div>
                    </x-dialog.panel>
                </x-dialog>
            </x-menu.items>
        </x-menu>

        @if($saved)
            <x-notifications
                icon="success"
                title="Contact modifié avec succès"
                method="$set('saved', false)"
            />
        @endif
    </td>
</tr>
