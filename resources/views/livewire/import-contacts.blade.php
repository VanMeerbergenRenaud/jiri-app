<div>
    <x-dialog>
        <x-dialog.open>
            <button type="button" class="import">
                <x-svg.import />
                <span>Importer des contacts</span>
            </button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit.prevent="import" class="form">
                @csrf

                @unless($upload)
                <div class="form__content">
                    <h2 class="title">Ajoutez votre fichier excel</h2>

                    <label for="upload">
                        Upload file
                        <input id="upload" wire:model="upload" type="file">
                        @error('upload')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        <span>Fichier de type CSV.</span>
                    </label>
                </div>
                @else
                    {{-- Configuration about the columns for name, firstname, email --}}
                    <div class="form__content">
                        <h2 class="title">Configurez l'ajout de vos données</h2>

                        <p class="p-2">
                            Veuillez sélectionner la colonne correspondante à celle de votre fichier importé.
                        </p>

                        <label for="name">
                            Nom
                            <select wire:model="fieldColumnMap.name" id="name">
                                <option value="" disabled>Sélectionnez une colonne</option>
                                @foreach($columns as $column)
                                    <option value="{{ $column }}">{{ $column }}</option>
                                @endforeach
                            </select>
                            @error('fieldColumnMap.name')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </label>

                        <label for="firstname">
                            Prénom
                            <select wire:model="fieldColumnMap.firstname" id="firstname">
                                <option value="" disabled>Sélectionnez une colonne</option>
                                @foreach($columns as $column)
                                    <option value="{{ $column }}">{{ $column }}</option>
                                @endforeach
                            </select>
                            @error('fieldColumnMap.firstname')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </label>

                        <label for="email">
                            Email
                            <select wire:model="fieldColumnMap.email" id="email">
                                <option value="" disabled>Sélectionnez une colonne</option>
                                @foreach($columns as $column)
                                    <option value="{{ $column }}">{{ $column }}</option>
                                @endforeach
                            </select>
                            @error('fieldColumnMap.email')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>
                @endif

                <x-dialog.footer>
                    <x-dialog.close>
                        <button type="button" class="cancel">Annuler</button>
                    </x-dialog.close>

                    <button type="submit" class="save">Importer</button>
                </x-dialog.footer>
            </form>
        </x-dialog.panel>
    </x-dialog>

    <div>
        @if($imported)
            <x-notifications
                icon="import"
                title="Liste de contact ajouté avec succès !"
                method="$set('imported', false)"
            />
        @endif
    </div>
</div>
