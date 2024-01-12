<div>
    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button" class="button--classic">Créer un nouveau projet</button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit="add" class="form">
                <div class="form__content">
                    <h2 class="title">Créer un nouveau projet</h2>

                    {{--@unless($projectCreated)--}}
                        <label>
                            Nom
                            <input autofocus wire:model="form.name">
                            @error('form.name')
                            <div class="error">{{ $message }}</div>@enderror
                        </label>

                        <label>
                            Description
                            <textarea wire:model="form.description" rows="3"></textarea>
                            @error('form.description')
                            <div class="error">{{ $message }}</div>@enderror
                        </label>
                    {{--@else--}}
                        <p class="font-semibold">Veuillez maintenant ajouter une ou plusieurs tâches au projet.</p>

                        <label>
                            Liste des tâches déjà existantes
                            <div x-data="{ selectedTask: [] }"
                                 x-init="() => {
                                const selectElement = document.getElementById('tasks');
                                const choices = new Choices(selectElement);
                                choices.passedElement.element.addEventListener('change', function(event) {
                                    selectedTask = Array.from(event.detail.value);
                                });
                            }">
                                <select id="tasks"
                                        multiple
                                        x-ref="selectElement"
                                        wire:model="form.selectedTasks"
                                >
                                    @foreach($allTasks as $task)
                                        <option value="{{ $task->name }}"
                                                wire:click="addSelectedTask({{ $task->id }})"
                                        >
                                            {{ $task->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('form.selectedTasks')<div class="error">{{ $message }}</div>@enderror
                        </label>

                        <label>
                            Nom de la nouvelle tâche
                            <input wire:model="form.newTask">
                            @error('form.newTask')<div class="error">{{ $message }}</div>@enderror
                        </label>
                    {{--@endif--}}
                </div>

                <x-dialog.footer>
                    <x-dialog.close>
                        <button type="button" class="cancel">Annuler</button>
                    </x-dialog.close>

                    <button type="submit" class="save">Créer</button>
                </x-dialog.footer>
            </form>
        </x-dialog.panel>
    </x-dialog>
</div>
