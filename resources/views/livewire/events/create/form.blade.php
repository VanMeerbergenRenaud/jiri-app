<div>
    {{-- Form to create a new contact --}}
    <template x-if="createmode">
        <form wire:submit.prevent="save" class="contact__new__form">
            <p>Ajouter un contact</p>
            <div class="contact__new__form__container">
                {{-- Type de contact --}}
                <label for="newcontacttype" class="contact__new__form__container__label">
                    Type
                    <select id="newcontacttype" wire:model="newcontacttype">
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
                <button type="button" class="cancel" @click="createmode = false">
                    Annuler
                </button>
                {{-- Button to save the new contact --}}
                <button type="submit" class="save">
                    Enregistrer
                </button>
                {{-- Validation message --}}
            </div>
        </form>
    </template>
</div>
