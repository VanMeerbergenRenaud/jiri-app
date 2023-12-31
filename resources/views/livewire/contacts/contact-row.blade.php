<tr>
    <td class="name capitalize">
        @if($contact->avatar)
            <img src="{{ asset($contact->avatar) . '?' . $contact->updated_at->format("U") }}"
                 alt="photo de profil du contact">
        @else
            <img src="{{ asset('img/placeholder.png') }}" alt="Image du contact" class="w-1/2 h-auto rounded-lg">
        @endif
        {{ $contact->name }}
    </td>
    <td class="capitalize">{{ $contact->firstname }}</td>
    <td class="lowercase">{{ $contact->email }}</td>
    <td class="actions">
        <x-menu>
            <x-menu.button>
                <x-svg.dots/>
            </x-menu.button>

            <x-menu.items>
                {{-- Item to show a contact --}}
                <x-menu.item>
                    <a class="link" href="{{ route('contacts.show', $contact) }}">
                        <x-svg.show/>

                        Voir
                    </a>
                </x-menu.item>

                {{-- Dialog to edit a contact --}}
                <x-dialog wire:model="showEditDialog" class="border-y w-full">
                    <x-dialog.open>
                        <x-menu.close>
                            <x-menu.item>
                                <div class="button">
                                    <x-svg.edit/>

                                    Modifier
                                </div>
                            </x-menu.item>
                        </x-menu.close>
                    </x-dialog.open>

                    <x-dialog.panel>
                        <form wire:submit="save" class="form">
                            <div class="form__content">
                                <h2 class="title">Modifier le contact</h2>

                                <label>
                                    Nom
                                    <input autofocus wire:model="form.name">
                                    @error('form.name')<div class="error">{{ $message }}</div>@enderror
                                </label>

                                <label>
                                    Prénom
                                    <input wire:model="form.firstname"/>
                                    @error('form.firstname')<div class="error">{{ $message }}</div>@enderror
                                </label>

                                <label>
                                    Email
                                    <input wire:model="form.email"/>
                                    @error('form.email')<div class="error">{{ $message }}</div>@enderror
                                </label>

                                <label for="file_input">
                                    Upload file
                                    <input id="file_input" wire:model="form.avatar" type="file">
                                    <span>JPG, JPEG, PNG or SVG (MAX 2000x1200px).</span>
                                    @error('form.avatar')<div class="error">{{ $message }}</div>@enderror
                                </label>

                                @if ($contact->avatar)
                                    <img src="{{ $contact->avatar }}" alt="Image du contact" class="w-1/2 h-auto rounded-lg">
                                @endif
                            </div>

                            <x-dialog.footer>
                                <x-dialog.close>
                                    <button type="button" class="cancel">Annuler</button>
                                </x-dialog.close>

                                <button type="submit" class="save">Sauvegarder</button>
                            </x-dialog.footer>
                        </form>
                    </x-dialog.panel>
                </x-dialog>

                {{-- Dialog to suppress a contact--}}
                <x-dialog class="w-full">
                    <x-dialog.open>
                        <x-menu.close>
                            <x-menu.item>
                                <div class="button">
                                    <x-svg.trash/>

                                    Supprimer
                                </div>
                            </x-menu.item>
                        </x-menu.close>
                    </x-dialog.open>

                    <x-dialog.panel>
                        <div x-data="{ confirmation: '' }">
                            <div class="panel__delete">
                                <div class="advertising">
                                    <x-svg.advertising/>
                                    <div class="advertising__content">
                                        <h3 class="title">Supprimer le contact</h3>
                                        <p class="description">
                                            Êtes-vous sûre de vouloir supprimer le contact
                                            <strong> {{ $contact->name }} {{ $contact->firstname }}</strong>&nbsp;? Toutes les données seront supprimées. Cette action est irréversible.
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
    </td>
</tr>
