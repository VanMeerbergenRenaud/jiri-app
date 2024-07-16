<div>
    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button" class="button--blue">Créer une nouvelle épreuve</button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit="add" class="form" wire:loading.class.delay="opacity-50">
                <div class="form__content">
                    <h2 class="title">Créer une nouvelle épreuve</h2>

                    <x-form.field
                        name="name"
                        label="Nom de l'épreuve"
                        type="text"
                        model="form.name"
                        placeholder="Ex : Jury juin {{ now()->year }}"
                    />

                    <x-form.field
                        label="Date de début"
                        name="starting_at"
                        type="datetime-local"
                        model="form.starting_at"
                        min="2020-01-01T00:00"
                        max="2038-01-01T00:00"
                        placeholder="{{ now()->format('Y-m-d\TH:i') }}"
                    />

                    <x-form.field
                        label="Durée de l'épreuve"
                        name="duration"
                        type="time"
                        model="form.duration"
                        min="00:01:00"
                        max="23:59:00"
                        placeholder="00:00:00"
                    />
                </div>

                <x-dialog.footer>
                    <x-dialog.close>
                        <button type="button" class="cancel">Annuler</button>
                    </x-dialog.close>

                    <button type="submit" class="save">Créer</button>
                </x-dialog.footer>
            </form>
        </x-dialog.panel>
    </x-dialog>

    <div>
        @if($added)
            <x-notifications
                icon="add"
                title="Épreuve ajoutée avec succès !"
                method="$set('added', false)"
            />
        @endif
    </div>
</div>
