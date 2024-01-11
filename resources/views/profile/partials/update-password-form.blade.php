<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Sauvegarder le mot de passe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester en sécurité.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-breeze.input-label for="current_password" :value="__('Mot de passe actuel')" />
            <x-breeze.text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full p-2" autocomplete="current-password" />
            <x-breeze.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-breeze.input-label for="password" :value="__('Nouveau mot de passe')" />
            <x-breeze.text-input id="password" name="password" type="password" class="mt-1 block w-full p-2" autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-breeze.input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-breeze.text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full p-2" autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-breeze.primary-button>{{ __('Sauvegarder') }}</x-breeze.primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Sauvegardé.') }}</p>
            @endif
        </div>
    </form>
</section>
