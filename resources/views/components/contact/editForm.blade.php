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

        <label>
            Importer une photo de profil
            <input wire:model="form.avatar" type="file">
            <span>JPG, JPEG, PNG ou SVG (MAX 1024 ko).</span>
            @error('form.avatar')<div class="error">{{ $message }}</div>@enderror
        </label>

        @if($contact->avatar)
            <img src="{{ $contact->avatar }}" alt="Image du contact" class="w-1/2 h-auto rounded-lg">
        @elseif($form->avatar)
            <img src="{{ $form->avatar->temporaryUrl() }}" alt="Image du contact" class="w-1/2 h-auto rounded-lg">
        @else
            <img src="{{ asset('img/placeholder.png') }}" alt="Image du contact" class="w-1/2 h-auto rounded-lg">
        @endif
    </div>

    <x-dialog.footer>
        <x-dialog.close>
            <button type="button" class="cancel">Annuler</button>
        </x-dialog.close>

        <button type="submit" class="save">Sauvegarder</button>
    </x-dialog.footer>
</form>
