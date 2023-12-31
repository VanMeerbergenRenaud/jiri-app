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

                    <label>
                        Liste des tâches
                        <x-form.select-multiple
                            wire:model="form.tasks"
                            tasks="$tasks"
                            :options="$allTasks->pluck('name')->toArray()"
                            selected="('form.tasks')"
                        />
                        @error('form.tasks')
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
