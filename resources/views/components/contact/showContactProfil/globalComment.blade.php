<form class="globalComment" wire:submit.prevent="saveGlobalComment">
    @csrf

    <div class="sectionHeader">
        <h3 role="heading" aria-level="3">Commentaire global</h3>

        <x-dialog wire:model="showCommentDialog">
            <x-dialog.open>
                <button type="button">
                    Editer
                </button>
            </x-dialog.open>

            <x-dialog.panel>
                <div class="form__content">
                    <h2 role="heading" aria-level="2" class="title">Commentaire global</h2>
                    <p class="text">
                        Veuillez ajouter un commentaire global pour l’étudiant.
                    </p>
                    <x-form.textarea
                        label="Commentaire global"
                        name="globalComment"
                        model="globalComment"
                        placeholder="Ajouter un commentaire global"
                        value="{{ $globalComment }}"
                        srOnly="true"
                        maxlength="1000"
                        class="globalComment__textarea"
                    />
                </div>

                <x-dialog.footer>
                    <x-dialog.close>
                        <button type="button" class="cancel">Annuler</button>
                    </x-dialog.close>

                    <button type="button"
                            wire:click="saveGlobalComment"
                            class="save">Enregistrer
                    </button>
                </x-dialog.footer>
            </x-dialog.panel>
        </x-dialog>
    </div>

    <p class="globalComment__text">
        {{ $globalComment }}
    </p>
</form>
