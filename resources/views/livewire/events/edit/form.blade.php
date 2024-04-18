<div>
    {{-- Form to edit a new contact --}}
    <template x-if="createmode">
        <form wire:submit.prevent="save" class="contact__new__form form">
            <p>Ajouter votre nouveau contact</p>
            <div class="contact__new__form__container">

                {{-- Type de contact --}}
                <label for="newcontacttype" class="contact__new__form__container__label">
                    Type
                    <select id="newcontacttype" wire:model="newcontacttype">
                        <option value="" selected>Sélectionner le type</option>
                        <option value="student">Étudiants</option>
                        <option value="evaluator">Évaluateurs</option>
                    </select>
                    @error('newcontacttype')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </label>

                {{-- Nom du contact --}}
                <div class="position-right">
                    <x-form.field
                        label="Nom du contact"
                        name="newcontactname"
                        type="text"
                        placeholder="Ex : Vilain"
                        model="newcontactname"
                        :messages="$errors->get('newcontactname')"
                    />
                </div>

                {{-- Prénom du contact --}}
                <div class="position-right">
                    <x-form.field
                        label="Prénom du contact"
                        name="newcontactfirstname"
                        type="text"
                        placeholder="Ex : Dominique"
                        model="newcontactfirstname"
                        :messages="$errors->get('newcontactfirstname')"
                    />
                </div>

                {{-- Adresse mail du contact --}}
                <div class="position-right">
                    <x-form.field
                        label="Adresse mail du contact"
                        name="newcontactemail"
                        type="email"
                        placeholder="Ex : dominique.vilain@hepl.be"
                        model="newcontactemail"
                        :messages="$errors->get('newcontactemail')"
                    />
                </div>

                {{-- Footer buttons --}}
                <div class="dialog__footer__buttons">
                    <button type="button" class="cancel" @click="createmode = false">
                        Annuler
                    </button>
                    <button type="submit" class="save">
                        Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </template>
</div>
