<div>
    {{-- Form to edit a new project --}}
    <template x-if="createmode">
        <form wire:submit.prevent="save" class="contact__new__form">
            <p>Ajouter votre nouveau projet</p>
            <div class="contact__new__form__container">

                {{-- Nom du projet --}}
                <div class="contact__new__form__container__label">
                    <x-form.field
                        label="Nom du projet"
                        name="newprojectname"
                        type="text"
                        placeholder="Ex : Portfolio"
                        model="newprojectname"
                        :messages="$errors->get('newprojectname')"
                    />
                </div>

                {{-- Tasks --}}
                <div class="contact__new__form__container__label">
                    <x-form.field
                        label="Tâches"
                        name="newprojecttasks"
                        type="text"
                        placeholder="Ex : Développement"
                        model="newprojecttasks"
                        :messages="$errors->get('newprojecttasks')"
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
