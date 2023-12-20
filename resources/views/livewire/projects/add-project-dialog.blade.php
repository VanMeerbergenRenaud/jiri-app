<div>
    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button" class="button--classic">Créer un nouveau projet</button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit="add" class="form">
                <div class="form__content">
                    <h2 class="title">Créer un nouveau projet</h2>

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

                    {{-- List of tasks in a select dropdown --}}
                    <label>
                        Liste des tâches
                        <select wire:model="form.tasks" class="p-2">
                            <option value="" selected>Choisissez une ou plusieurs tâches</option>
                            @if($project->tasks)
                                @forelse($project->tasks as $task)
                                    <option wire:key="{{ $task->id }}" value="{{ $task->name }}">{{ $task->name }}</option>
                                @empty
                                    <option value="">Aucune tâches disponibles</option>
                                @endforelse
                            @else
                                <option value="">Aucun projet sélectionné</option>
                            @endif
                        </select>
                    </label>

                    {{-- TODO : add a task associted to a project --}}
                    <label>
                        Tâches
                        <input wire:model="form.task">
                        @error('form.task')
                        <div class="error">{{ $message }}</div>@enderror
                    </label>
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
