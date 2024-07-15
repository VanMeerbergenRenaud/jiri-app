<div>
    {{-- Form to edit a new project --}}
    <template x-if="createmode">
        <form wire:submit.prevent="save" class="contact__new__form">
            @csrf

            <p>Ajouter votre nouveau projet</p>
            <div class="contact__new__form__container">

                {{-- Nom du projet --}}
                <div class="contact__new__form__container__label">
                    <x-form.field
                        label="Nom du projet"
                        name="name"
                        type="text"
                        placeholder="Ex : Portfolio"
                        model="name"
                    />
                </div>

                {{-- Tasks --}}
                <div class="contact__new__form__container__label">
                    <x-form.field
                        label="Tâches"
                        name="tasks"
                        type="text"
                        placeholder="Ex : Intégration"
                        model="tasks"
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
