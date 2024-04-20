<div>
    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button" class="button--blue">Créer un nouveau contact</button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit="add" class="form">
                <div class="form__content">
                    <h2 class="title">Créer un nouveau contact</h2>

                    <x-form.field
                        label="Nom"
                        name="name"
                        type="text"
                        model="form.name"
                        placeholder="John"
                        :messages="$errors->get('form.name')"
                        autofocus
                    />

                    <x-form.field
                        label="Prénom"
                        name="firstname"
                        type="text"
                        model="form.firstname"
                        placeholder="Doe"
                        :messages="$errors->get('form.firstname')"
                    />

                    <x-form.field
                        label="Email"
                        name="email"
                        type="email"
                        model="form.email"
                        placeholder="john.doe@gmail.com"
                        :messages="$errors->get('form.email')"
                    />

                    <label>
                        Importer une photo de profil
                        <input wire:model="form.avatar" type="file">
                        <span>JPG, JPEG, PNG or SVG (MAX 1024 ko).</span>
                        @error('form.avatar')<div class="error">{{ $message }}</div>@enderror

                        @if($form->avatar)
                            <img src="{{ $form->avatar->temporaryUrl() }}" alt="Image du contact" class="w-1/2 h-auto rounded-lg">
                        @endif
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
