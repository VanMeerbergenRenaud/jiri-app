<section class="profile-admin__section">
    <h2 role="heading" aria-level="2" class="profile-admin__section__title">
        {{ __('Supprimer le compte') }}
    </h2>

    <p class="profile-admin__section__text">
        {{ __('Dès que votre compte se sera supprimé, toutes les données et ressources associées seront supprimées de manière permanente. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
    </p>

    <button class="button-danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Supprimer le compte') }}
    </button>

    <x-breeze.modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="form form-danger">
            @csrf
            @method('delete')

            <h3 role="heading" aria-level="3" class="form-danger__title">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h3>

            <p class="form-danger__text">
                {{ __('Une fois votre compte supprimé, toutes les données et ressources associées seront supprimées de manière permanente. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer votre compte de manière permanente.') }}
            </p>

            <div class="form__field">
                <x-breeze.input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />
                <x-breeze.text-input id="password" name="password" type="password" placeholder="{{ __('Mot de passe') }}"/>
                <x-breeze.input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="form__footer">
                <button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </button>

                <button class="button-danger">
                    {{ __('Supprimer le compte') }}
                </button>
            </div>
        </form>
    </x-breeze.modal>
</section>
