<form wire:submit="saveContact" class="form">
    <div class="form__content">
        <h2 class="title">Modifier le contact</h2>

        <x-form.field
            label="Nom"
            name="name"
            type="text"
            model="form.name"
            placeholder="John"
            value="{{ $contact->name }}"
            autofocus
        />

        <x-form.field
            label="Prénom"
            name="firstname"
            type="text"
            model="form.firstname"
            placeholder="Doe"
            value="{{ $contact->firstname }}"
        />

        <x-form.field
            label="Email"
            name="email"
            type="email"
            model="form.email"
            placeholder="john.doe@gmail.com"
            value="{{ $contact->email }}"
        />

        <x-form.field
            label="Importer une photo de profil"
            name="avatar"
            type="file"
            model="form.avatar"
            placeholder="JPG, JPEG, PNG ou SVG (MAX 1024 ko)"
            value="{{ $contact->avatar }}"
        />

        @if($form->avatar instanceof \Illuminate\Http\UploadedFile)
            <img src="{{ $form->avatar->temporaryUrl() }}" alt="Image du contact" class="temporary_url">
        @elseif($contact->avatar)
            <img src="{{ $contact->avatar }}" alt="Image du contact" class="temporary_url">
        @else
            <img src="{{ asset('img/placeholder.png') }}" alt="Image du contact" class="temporary_url">
        @endif
    </div>

    <x-dialog.footer>
        <x-dialog.close>
            <button type="button" class="cancel">Annuler</button>
        </x-dialog.close>

        <button type="submit" class="save">Sauvegarder</button>
    </x-dialog.footer>
</form>
