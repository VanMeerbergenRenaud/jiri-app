<div class="sectionHeader">
    Profil

    <x-dialog wire:model="showEditDialog">
        <x-dialog.open>
            <button type="button">Editer le profil</button>
        </x-dialog.open>
        <x-dialog.panel>
            <x-contact.editForm :contact="$contact" :form="$form"/>
        </x-dialog.panel>
    </x-dialog>
</div>

<div class="mainProfil__content__profil__form">
    <label for="Photo">Photo</label>
    <div class="mainProfil__content__profil__form__photo">
        <div>
            <img src="{{ $contact->avatar ?? asset('img/placeholder.png') }}" alt="Photo de l'étudiant">
            <span>
                @include('components.svg.edit')
            </span>
        </div>
        <span>
            Accepte les fichiers de type<br>
            .jpg, .jpeg, .png ou .svg<br>
        </span>
    </div>
    {{-- Nom, prénom, adresse mail, site de référence et compte Github --}}
    <div class="mainProfil__content__profil__form__infos">
        <h3 class="title">Nom</h3>
        <p class="text">{{ $contact->name }}</p>

        <h3 class="title">Prénom</h3>
        <p class="text">{{ $contact->firstname }}</p>

        <h3 class="title">Adresse mail</h3>
        <p class="text">{{ $contact->email ?? 'Non renseigné' }}</p>

        <h3 class="title">Site de référence</h3>
        <p class="text">{{ $contact->site ?? 'Non renseigné' }}</p>

        <h3 class="title">Compte GitHub</h3>
        <p class="text">{{ $contact->github ?? 'Non renseigné' }}</p>
    </div>
</div>
