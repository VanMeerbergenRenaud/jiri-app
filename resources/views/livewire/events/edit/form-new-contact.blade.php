<div>
    {{-- FormNewContact to edit a new contact --}}
    <template x-if="createmode">
        <form
            wire:submit="addContactToEvent"
            class="contact__new__form form"
        >
            <p>Ajouter votre nouveau contact</p>
            <div class="contact__new__form__container">

                {{-- Type de contact --}}
                <div class="contact__new__form__container__select">
                    <label for="role">
                        Rôle du contact
                    </label>
                    <select name="role" id="role" wire:model="role">
                        <option disabled selected value="">Choisissez un type</option>
                        <option value="student">Étudiant</option>
                        <option value="evaluator">Évaluateur</option>
                    </select>
                </div>

                {{-- Nom du contact --}}
                <div class="position-right">
                    <x-form.field
                        label="Nom du nouveau contact"
                        name="name"
                        type="text"
                        model="name"
                        placeholder="Vilain"
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

    <div>
        @if($saved)
            <x-notifications
                icon="success"
                title="Contact créé et ajouté à l'épreuve !"
                method="$set('saved', false)"
            />
        @endif
    </div>
</div>
