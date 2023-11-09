 <div class="filter__contacts"
      x-data="{
        createmode: false,
        contactname: ''
    }"
 >
    {{-- Search input --}}
    <label for="contactname">
        <input
            type="text"
            id="contactname"
            wire:model.live="contactname"
            class="filter__contacts__input"
            placeholder="Chercher un contact"
        >
    </label>
    {{-- List of contacts --}}
    @unless($this->contacts->isEmpty())
        <ol class="filter__contacts__list">
            @foreach($this->contacts as $contact)
                <li wire:key="{{ $contact->id }}" class="filter__contacts__list__item">
                    <span>{{ $contact->name }}</span>
                    <span>{{ $contact->lastname }}</span>
                    <span>{{ $contact->email }}</span>
                    <button id="user{{$contact->id}}">Ajouter</button>
                </li>
            @endforeach
        </ol>
    @else
        <p class="no-contact">Aucun contact trouvé.</p>
    @endunless

    {{-- Form to create a new contact --}}
    <template x-if="createmode">
        <form wire:submit.prevent="save" class="contact__new__form">
            <p>Ajouter un contact</p>
            <div class="contact__new__form__container">
                {{-- Type de contact --}}
                <label for="newcontacttype" class="contact__new__form__container__label">
                    Type
                    <select name="newcontacttype" id="newcontacttype">
                        <option value="0">Sélectionner le type</option>
                        <option value="1">Étudiant</option>
                        <option value="2">Jury</option>
                        <option value="3">Neutre</option>
                    </select>
                    @error('newcontacttype')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </label>
                {{-- Nom du contact --}}
                <div class="position-right">
                    <label for="newcontactname">Nom du contact</label>
                    <input
                        type="text"
                        id="newcontactname"
                        wire:model="newcontactname"
                        x-model="contactname"
                        placeholder="Ex : Vilain"
                    >
                    @error('newcontactname')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Prénom du contact --}}
                <div class="position-right">
                    <label for="newcontactlastname">Prénom du contact</label>
                    <input
                        type="text"
                        id="newcontactlastname"
                        wire:model="newcontactlastname"
                        placeholder="Ex : Dominique"
                    >
                    @error('newcontactlastname')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Adresse mail du contact --}}
                <div class="position-right">
                    <label for="newcontactemail">Adresse mail du contact</label>
                    <input
                        type="email"
                        id="newcontactemail"
                        wire:model="newcontactemail"
                        placeholder="Ex : dominique.vilain@hepl.be"
                    >
                    @error('newcontactemail')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Button to cancel the new contact --}}
                <button type="button"
                        class="cancel"
                        @click="createmode = false">
                    Annuler
                </button>
                {{-- Button to save the new contact --}}
                <button type="submit"
                        class="save"
                        x-show="createmode"
                        @click="$wire.set('newcontactname', contactname)">
                    Enregistrer
                </button>
                {{-- Validation message --}}
                <div x-data="{ showSuccessMessage: false }" class="success-message">
                    @if ($saved && !$errors->any())
                        <p id="success-message"
                           x-show.transition.duration.500ms="showSuccessMessage"
                           x-init="
                               showSuccessMessage = true;
                               setTimeout(() => { showSuccessMessage = false }, 5000);
                           ">
                            Le contact a été enregistré avec succès !
                        </p>
                    @endif
                </div>
            </div>
        </form>
    </template>

    {{-- Button to create a new contact --}}
    <button type="button"
         class="add-button"
         x-show="!createmode"
         @click="createmode = true; contactname=$wire.get('contactname')">
        Ajouter un contact
    </button>
 </div>
