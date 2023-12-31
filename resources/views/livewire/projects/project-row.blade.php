<tr>
    <td class="name capitalize">{{ $project->name }}</td>
    <td class="capitalize">{{ str($project->description)->limit(50) }}</td>
    <td class="tasks">
        @foreach($tasks as $task)
            <span>{{ $task->name }}</span>
        @endforeach
    </td>
    <td class="actions">
        <x-menu>
            <x-menu.button>
                <x-svg.dots/>
            </x-menu.button>

            <x-menu.items>
                {{-- Item to show a project --}}
                <x-menu.item>
                    <a class="link" href="{{ route('projects.show', $project) }}">
                        <x-svg.show/>

                        Voir
                    </a>
                </x-menu.item>

                {{-- Dialog to edit a project --}}
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
                                <h2 class="title">Modifier le project</h2>

                                <label>
                                    Nom
                                    <input autofocus wire:model="form.name">
                                    @error('form.name')
                                    <div class="error">{{ $message }}</div>@enderror
                                </label>

                                <label>
                                    Description
                                    <input wire:model="form.description"/>
                                    @error('form.description')
                                    <div class="error">{{ $message }}</div>@enderror
                                </label>

                                {{-- List of tasks in a select dropdown --}}
                                Liste des tâches
                                <x-form.select-multiple
                                    wire:mode.livel="form.tasks"
                                    tasks="$tasks"
                                    :options="$allTasks->pluck('name')->toArray()"
                                    selected="('form.tasks')"
                                />

                                <div>
                                    @foreach($tasks as $task)
                                        <ul>
                                            <li class="list-disc">{{ $task->name }}</li>
                                        </ul>
                                    @endforeach
                                </div>
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

                {{-- Dialog to suppress a project--}}
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
                                        <h3 class="title">Supprimer le projet</h3>
                                        <p class="description">
                                            Êtes-vous sûre de vouloir supprimer le projet
                                            <strong> {{ $project->name }}</strong>&nbsp;? Toutes les données seront supprimées. Cette action est irréversible.
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

