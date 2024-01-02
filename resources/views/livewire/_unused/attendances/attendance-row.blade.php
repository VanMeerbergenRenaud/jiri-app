<tr>
    <td class="name capitalize">{{ $attendance->role }}</td>
    <td class="lowercase">{{ $attendance->token }}</td>

    <td class="capitalize">{{ $attendance->contact->name }}</td>
    <td class="capitalize">{{ $attendance->contact->firstname }}</td>
    <td class="lowercase">{{ $attendance->contact->email }}</td>
    <td>{{ $attendance->contact->photo }}</td>

    <td class="actions">
        <x-menu>
            <x-menu.button>
                <x-svg.dots/>
            </x-menu.button>

            <x-menu.items>
                {{-- Item to show a attendance --}}
                <x-menu.item>
                    <a class="link" href="{{ route('contacts.show', $attendance) }}">
                        <x-svg.show/>

                        Voir
                    </a>
                </x-menu.item>

                {{-- Dialog to edit a attendance --}}
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
                                <h2 class="title">Modifier l‘attendance</h2>

                                <label>
                                    Nom
                                    <input wire:model="form.name" />
                                    @error('form.name')<div class="error">{{ $message }}</div>@enderror
                                </label>

                                <label>
                                    Prénom
                                    <input wire:model="form.firstname" />
                                    @error('form.firstname')<div class="error">{{ $message }}</div>@enderror
                                </label>

                                <label>
                                    Adresse mail
                                    <input wire:model="form.email" />
                                    @error('form.email')<div class="error">{{ $message }}</div>@enderror
                                </label>

                                <label>
                                    Rôle
                                    <select wire:model="form.role">
                                        <option value="" selected disabled>Choisissez un rôle</option>
                                        <option value="student">Étudiant</option>
                                        <option value="evaluator">Evaluateur</option>
                                    </select>
                                    @error('form.role')<div class="error">{{ $message }}</div>@enderror
                                </label>

                                <label>
                                    Token
                                    <input wire:model="form.token" />
                                    @error('form.token')<div class="error">{{ $message }}</div>@enderror
                                </label>
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

                {{-- Dialog to suppress an attendance--}}
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
                                        <h3 class="title">Supprimer l‘attendance</h3>
                                        <p class="description">
                                            Êtes-vous sûre de vouloir supprimer le contact
                                            <strong> {{ $attendance->contact->name }}</strong>
                                            qui est
                                            <strong> {{ $attendance->role }}</strong>&nbsp;? Toutes les données seront supprimées. Cette action est irréversible.
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
