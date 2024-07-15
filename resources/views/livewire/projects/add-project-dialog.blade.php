<div>
    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button" class="button--blue">Créer un nouveau projet</button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit="add" class="form">
                @csrf

                <div class="form__content">
                    <h2 class="title">Créer un nouveau projet</h2>

                    {{-- Name, description, tasks --}}
                    <x-form.field
                        label="Nom"
                        name="name"
                        type="text"
                        model="form.name"
                        value="{{ old('name') }}"
                        placeholder="Nom du projet"
                        autofocus
                    />

                    <x-form.textarea
                        label="Description"
                        name="description"
                        model="form.description"
                        value="{{ old('description') }}"
                        placeholder="Informations sur le projet"
                    />

                    <x-form.field
                        label="Url de présentation"
                        name="url_readme"
                        type="text"
                        model="form.url_readme"
                        value="{{ old('url_readme') }}"
                        placeholder="https://example.com"
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
</div>
