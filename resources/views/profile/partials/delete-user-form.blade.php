<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Supprimer le compte') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Dès que votre compte se sera supprimé, toutes les données et ressources associées seront supprimées de manière permanente. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <x-breeze.danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Supprimer le compte') }}</x-breeze.danger-button>

    <x-breeze.modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Une fois votre compte supprimé, toutes les données et ressources associées seront supprimées de manière permanente. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer votre compte de manière permanente.') }}
            </p>

            <div class="mt-6">
                <x-breeze.input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />

                <x-breeze.text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 p-2"
                    placeholder="{{ __('Mot de passe') }}"
                />

                <x-breeze.input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-breeze.secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </x-breeze.secondary-button>

                <x-breeze.danger-button class="ml-3">
                    {{ __('Supprimer le compte') }}
                </x-breeze.danger-button>
            </div>
        </form>
    </x-breeze.modal>
</section>
