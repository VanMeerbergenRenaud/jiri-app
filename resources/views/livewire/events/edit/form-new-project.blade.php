<div>
    {{-- FormNewContact to edit a new project --}}
    <template x-if="createmode">
        <form wire:submit.prevent="addProjectToEvent" class="contact__new__form">
            @csrf

            <p>Ajouter votre nouveau projet</p>
            <div class="project__new__form__container">

                {{-- Nom du projet --}}
                <div class="project__form">
                    <x-form.field
                        label="Nom du nouveau projet"
                        name="name"
                        type="text"
                        placeholder="Portfolio"
                        model="name"
                    />
                </div>

                {{-- Url de présentation --}}
                <div class="project__form">
                    <x-form.field
                        label="Url de présentation"
                        name="url_readme"
                        type="text"
                        placeholder="https://github.com/project/read_me"
                        model="url_readme"
                    />
                </div>

                {{-- Description --}}
                <div class="project__form">
                    <x-form.textarea
                        label="Description brève du projet"
                        name="description"
                        placeholder="Réalisation de mon portfolio"
                        model="description"
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

    @if($newProject)
        <x-notifications
            icon="add"
            title="Nouveau projet ajouté à l'épreuve !"
            method="$set('newProject', false)"
        />
    @endif
</div>
