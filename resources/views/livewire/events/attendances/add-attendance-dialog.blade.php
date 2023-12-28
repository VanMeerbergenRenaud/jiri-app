<div>
    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button" class="button--classic">Créer une nouvelle attendance</button>
        </x-dialog.open>

        <x-dialog.panel>
            <form wire:submit="add" class="form">
                <div class="form__content">
                    <h2 class="title">Créer une nouvelle attendance</h2>

                    <label>
                        Nom
                        <input wire:model="contactForm.name" />
                        @error('contactForm.name')<div class="error">{{ $message }}</div>@enderror
                    </label>

                    <label>
                        Prénom
                        <input wire:model="contactForm.firstname" />
                        @error('contactForm.firstname')<div class="error">{{ $message }}</div>@enderror
                    </label>

                    <label>
                        Adresse mail
                        <input wire:model="contactForm.email" />
                        @error('contactForm.email')<div class="error">{{ $message }}</div>@enderror
                    </label>

                    <label>
                        Rôle
                        <select wire:model="attendanceForm.role">
                            <option value="" selected disabled>Choisissez un rôle</option>
                            <option value="student">Étudiant</option>
                            <option value="evaluator">Evaluateur</option>
                        </select>
                        @error('attendanceForm.role')<div class="error">{{ $message }}</div>@enderror
                    </label>

                    <label>
                        Token
                        <input wire:model="attendanceForm.token" />
                        @error('attendanceForm.token')<div class="error">{{ $message }}</div>@enderror
                    </label>
                </div>

                <x-dialog.footer>
                    <x-dialog.close>
                        <button type="button" class="cancel">Annuler</button>
                    </x-dialog.close>

                    <button type="submit" class="save">Ajouter</button>
                </x-dialog.footer>
            </form>
        </x-dialog.panel>
    </x-dialog>

    <div>
        @if($added)
            <x-notifications
                icon="add"
                title="Contact ajouté avec succès !"
                message="Vous avez ajouté une nouvelle attendance."
                method="$set('saved', false)"
            />
        @endif
    </div>
</div>
