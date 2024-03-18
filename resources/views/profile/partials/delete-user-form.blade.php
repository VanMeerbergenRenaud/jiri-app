<section class="profile-admin__section">
    <h2 role="heading" aria-level="2" class="profile-admin__section__title">
        {{ __('Supprimer le compte') }}
    </h2>

    <p class="profile-admin__section__text">
        {{ __('Dès que votre compte se sera supprimé, toutes les données et ressources associées seront supprimées de manière permanente. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
    </p>


    <x-dialog wire:model="show">
        <x-dialog.open>
            <button type="button" class="button--danger">
                {{ __('Supprimer le compte') }}
            </button>
        </x-dialog.open>

        <x-dialog.panel>
            <form method="post" action="{{ route('profile.destroy') }}" class="form">
                @csrf
                @method('delete')

                <div class="form__content">
                    <!-- <x-svg.advertising /> -->
                    <h3 role="heading" aria-level="3" class="title">
                        {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
                    </h3>

                    <p class="text">
                        {{ __('Une fois votre compte supprimé, toutes les données et ressources associées seront supprimées de manière permanente. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer votre compte de manière permanente.') }}
                    </p>

                    <div class="form__field">
                        <x-breeze.input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />
                        <x-breeze.text-input id="password" name="password" type="password" placeholder="{{ __('Mot de passe') }}"/>
                        <x-breeze.input-error :messages="$errors->userDeletion->get('password')" />
                    </div>
                </div>

                <x-dialog.footer>
                    <x-dialog.close>
                        <button type="button" class="cancel">
                            {{ __('Annuler') }}
                        </button>
                    </x-dialog.close>

                    <button type="submit" class="delete">
                        {{ __('Supprimer le compte') }}
                    </button>
                </x-dialog.footer>
            </form>
        </x-dialog.panel>
    </x-dialog>
</section>
