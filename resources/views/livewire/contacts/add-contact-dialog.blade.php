<div>
    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button" class="button--classic">Créer un nouveau contact</button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit="add" class="form">
                <div class="form__content">
                    <h2 class="title">Créer un nouveau contact</h2>

                    <label>
                        Nom
                        <input autofocus wire:model="form.name">
                        @error('form.name')
                        <div class="error">{{ $message }}</div>@enderror
                    </label>

                    <label>
                        Prénom
                        <input wire:model="form.firstname"/>
                        @error('form.firstname')
                        <div class="error">{{ $message }}</div>@enderror
                    </label>

                    <label>
                        Email
                        <input wire:model="form.email"/>
                        @error('form.email')
                        <div class="error">{{ $message }}</div>@enderror
                    </label>

                    <label for="file_input">
                        Upload file
                        <input id="file_input" wire:model="form.avatar" type="file">
                        <span>JPG, JPEG, PNG or SVG (MAX 2000x1200px).</span>
                        @error('form.avatar')
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

    <div>
        @if($added)
            <x-notifications
                icon="add"
                title="Contact ajouté avec succès !"
                message="Vous avez ajouté un nouveau contact."
                method="$set('saved', false)"
            />
        @endif
    </div>
</div>
