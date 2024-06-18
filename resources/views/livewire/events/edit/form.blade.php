<div>
    {{-- Form to edit a new contact --}}
    <template x-if="createmode">
        <form
            wire:submit="addContactToEvent"
            class="contact__new__form form"
        >
            <p>Ajouter votre nouveau contact</p>
            <div class="contact__new__form__container">

                {{-- Type de contact --}}
                <div>
                    <label for="role">
                        Veuillez choisir un rôle ci-dessous&nbsp;:
                    </label>
                    <select name="role" id="role" wire:model="role">
                        <option disabled selected value="">Choisissez un type</option>
                        <option value="student">Étudiant</option>
                        <option value="evaluator">Évaluateur</option>
                    </select>
                    @error('role')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Nom du contact --}}
                <div class="position-right">
                    <x-form.field
                        label="Nom du nouveau contact"
                        name="name"
                        type="text"
                        model="name"
                        placeholder="Vilain"
                        :messages="$errors->get('name')"
                    />
                </div>

                {{-- Prénom du contact --}}
                <div class="position-right">
                    <x-form.field
                        label="Prénom du nouveau contact"
                        name="firstname"
                        type="text"
                        model="firstname"
                        placeholder="Dominique"
                        :messages="$errors->get('firstname')"
                    />
                </div>

                {{-- Adresse mail du contact --}}
                <div class="position-right">
                    <x-form.field
                        label="Adresse mail du nouveau contact"
                        name="email"
                        type="email"
                        model="email"
                        placeholder="john.doe@gmail.com"
                        :messages="$errors->get('email')"
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
