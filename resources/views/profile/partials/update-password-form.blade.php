<section class="profile-admin__section">
    <h2 class="profile-admin__section__title">
        {{ __('Sauvegarder le mot de passe') }}
    </h2>

    <p class="profile-admin__section__text">
        {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester en sécurité.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}" class="form">
        @csrf
        @method('put')

        <div class="form__field">
            <x-breeze.input-label for="current_password" :value="__('Mot de passe actuel')" />
            <x-breeze.text-input id="current_password" name="current_password" type="password" autocomplete="current-password" />
            <x-breeze.input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="form__field">
            <x-breeze.input-label for="password" :value="__('Nouveau mot de passe')" />
            <x-breeze.text-input id="password" name="password" type="password" autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div class="form__field">
            <x-breeze.input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-breeze.text-input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="form__footer">
            <button>{{ __('Sauvegarder') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                >{{ __('Sauvegardé.') }}</p>
            @endif
        </div>
    </form>
</section>
