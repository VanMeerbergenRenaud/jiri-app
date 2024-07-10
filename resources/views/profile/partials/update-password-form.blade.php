<section class="profile-admin__section">
    <h2 class="profile-admin__section__title">
        {{ __('Sauvegarder le mot de passe') }}
    </h2>

    <p class="profile-admin__section__text">
        {{ __('Assurez-vous que votre compte utilise un mot de passe long (minimum 8 caractères) et aléatoire pour rester en sécurité.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}" class="form profile-admin__section__form">
        @csrf
        @method('put')

        <x-form.breeze-field-password
            label="{{ __('Mot de passe actuel') }}"
            name="current_password"
            placeholder="{{ __('Inscrivez votre mot de passe actuel') }}"
            autocomplete="current-password"
            required
            :messages="$errors->updatePassword->get('current_password')"
        />

        <x-form.breeze-field-password
            label="{{ __('Nouveau mot de passe') }}"
            name="password"
            placeholder="{{ __('Inscrivez votre nouveau mot de passe') }}"
            autocomplete="new-password"
            required
            :messages="$errors->updatePassword->get('password')"
        />

        <x-form.breeze-field-password
            label="{{ __('Confirmer le mot de passe') }}"
            name="password_confirmation"
            placeholder="{{ __('Confirmer votre nouveau mot de passe') }}"
            autocomplete="new-password"
            required
            :messages="$errors->updatePassword->get('password_confirmation')"
        />

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
