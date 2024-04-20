<form wire:submit="save" class="form">
    <div class="form__content">
        <h2 class="title">Modifier le contact</h2>

        <x-form.field
            label="Nom"
            name="name"
            type="text"
            model="form.name"
            placeholder="John"
            value="{{ $contact->name }}"
            :messages="$errors->get('form.name')"
            autofocus
        />

        <x-form.field
            label="Prénom"
            name="firstname"
            type="text"
            model="form.firstname"
            placeholder="Doe"
            value="{{ $contact->firstname }}"
            :messages="$errors->get('form.firstname')"
        />

        <x-form.field
            label="Email"
            name="email"
            type="email"
            model="form.email"
            placeholder="john.doe@gmail.com"
            value="{{ $contact->email }}"
            :messages="$errors->get('form.email')"
        />

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
