 <div class="filter__contacts"
      x-data="{
        createmode: false,
        contactname: ''
    }"
 >
        <label for="contactname">
            <input type="text" id="contactname" wire:model.live="contactname" class="filter__contacts__input" placeholder="Chercher un contact">
        </label>
        @unless($this->contacts->isEmpty())
            <ol class="filter__contacts__list">
                @foreach($this->contacts as $contact)
                    <li wire:key="{{ $contact->id }}" class="filter__contacts__list__item">
                        <span>{{ $contact->name }}</span>
                        <span>{{ $contact->email }}</span>
                        <button id="user{{$contact->id}}">Ajouter</button>
                    </li>
                @endforeach
            </ol>
        @else
            <p class="no-contact">Aucun contact trouvé.</p>
        @endunless

    <template x-if="createmode">
        <form wire:submit="save" class="contact__new__form">
            <p>Ajouter un contact</p>
            <div class="contact__new__form__container">
                <label for="contactType" class="contact__new__form__container__label">
                    Type
                    <select name="contactType" id="contactType">
                        <option value="0">Sélectionner le type</option>
                        <option value="1">Étudiant</option>
                        <option value="2">Jury</option>
                        <option value="3">Neutre</option>
                    </select>
                </label>
                {{-- Nom du contact --}}
                <div class="position-right">
                    <label for="newcontactname">Nom du contact</label>
                    <input type="text" id="newcontactname" wire:model="newcontactname" x-model="contactname" placeholder="Ex : Vilain">
                </div>
                {{-- Prénom du contact --}}
                <div class="position-right">
                    <label for="newcontactlastname">Prénom du contact</label>
                    <input type="text" id="newcontactlastname" wire:model="newcontactlastname" x-model="contactlastname" placeholder="Ex : Dominique">
                </div>
                {{-- Adresse mail du contact --}}
                <div class="position-right">
                    <label for="newcontactemail">Adresse mail du contact</label>
                    <input type="email" id="newcontactemail" wire:model="newcontactemail" placeholder="Ex : dominique.vilain@hepl.be">
                </div>
                {{-- Buttons to cancel or save the new contact --}}
                <button @click="createmode = false" type="button" class="cancel">Annuler</button>
                <button x-show="createmode" type="submit" @click="$wire.set('newcontactname', contactname)" class="save">Enregistrer</button>
            </div>
        </form>
    </template>

    <button type="button" class="add-button" x-show="!createmode" @click="createmode = true; contactname=$wire.get('contactname')">
        Ajouter un contact
    </button>
 </div>
