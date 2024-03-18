<div>
    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button" class="button--blue">Créer une nouvelle épreuve</button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit="add" class="form">
                <div class="form__content">
                    <h2 class="title">Créer une nouvelle épreuve</h2>

                    <label>
                        Nom
                        <input
                            wire:model="form.name"
                            type="text"
                            autofocus
                            placeholder="Jury juin {{ date('Y') }}"
                        >
                        @error('form.name')<div class="error">{{ $message }}</div>@enderror
                    </label>

                    <label>
                        Commencement
                        <input
                            wire:model="form.starting_at"
                            type="datetime-local"
                        />
                        @error('form.starting_at')<div class="error">{{ $message }}</div>@enderror
                    </label>

                    <label>
                        Durée
                        <input
                            wire:model="form.duration"
                            type="time"
                            step="1" minutes="1"
                            max="23:59"
                        />
                        @error('form.duration')<div class="error">{{ $message }}</div>@enderror
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

    <div>
        @if($added)
            <x-notifications
                icon="add"
                title="Épreuve ajoutée avec succès !"
                message="Vous avez ajouté une nouvelle épreuve."
                method="$set('saved', false)"
            />
        @endif
    </div>
</div>
