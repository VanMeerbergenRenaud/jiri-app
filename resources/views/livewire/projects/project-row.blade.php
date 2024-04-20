<tr>
    <td class="name capitalize">
        <a href="{{ route('projects.show', $project) }}" title="Voir le projet">
            {{ $project->name }}
        </a>
    </td>
    <td class="capitalize">{{ str($project->description)->limit(50) }}</td>
    <td class="tasks">
        {{ implode(' | ', json_decode($project->tasks)) }}
    </td>
    <td class="actions">
        <x-menu>
            <x-menu.button>
                <x-svg.dots/>
            </x-menu.button>

            <x-menu.items>
                {{-- Item to show a project --}}
                <a class="link" href="{{ route('projects.show', $project) }}">
                    <x-svg.show/>

                    Voir
                </a>

                <x-divider />

                {{-- Dialog to edit a project --}}
                <x-dialog wire:model="showEditDialog" class="w-full">
                    <x-dialog.open>
                        <x-menu.close>
                            <x-menu.item>
                                <x-svg.edit/>

                                Modifier
                            </x-menu.item>
                        </x-menu.close>
                    </x-dialog.open>

                    <x-dialog.panel>
                        <form wire:submit="save" class="form">
                            @csrf
                            <div class="form__content">
                                <h2 class="title">Modifier le project</h2>

                                {{-- Nom, description, tâches selection --}}
                                <x-form.field
                                    label="Nom"
                                    name="name"
                                    type="text"
                                    model="form.name"
                                    placeholder="Nom du projet"
                                    value="{{ $project->name }}"
                                    :messages="$errors->get('nom')"
                                    required
                                    autofocus
                                />

                                <x-form.textarea
                                    label="Description"
                                    name="description"
                                    model="form.description"
                                    placeholder="Informations sur le projet"
                                    value="{{ $project->description }}"
                                    :messages="$errors->get('description')"
                                />

                                <x-form.field
                                    label="Tâches"
                                    name="tasks"
                                    type="text"
                                    model="form.tasks"
                                    placeholder="Tâches à réaliser"
                                    value="{{ $project->tasks }}"
                                    :messages="$errors->get('tasks')"
                                />
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

                <x-divider />

                {{-- Dialog to suppress a project--}}
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
                                        <h3 class="title">Supprimer le projet</h3>
                                        <p class="description">
                                            Êtes-vous sûre de vouloir supprimer le projet
                                            <span class="font-semibold"> {{ $project->name }}</span>&nbsp;? Toutes les données seront supprimées. Cette action est irréversible.
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
