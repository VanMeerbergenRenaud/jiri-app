<x-guest-layout>
    <form method="POST" action="{{ route('password.confirm') }}" class="form">
        @csrf

        <!-- Warning -->
        <p class="form__text">
            {{ __("Il s'agit d'une zone sécurisée de l'application. Veuillez confirmer votre mot de passe avant de continuer.") }}
        </p>

        <!-- Password -->
        <x-form.breeze-field-password
            label="Mot de passe"
            name="password"
            placeholder="Quel est votre mot de passe ?"
            autocomplete="current-password"
            required
            :messages="$errors->get('password')"
            autofocus
        />

        <div class="form__footer">
            <button type="submit">
                {{ __('Confirmer') }}
            </button>
        </div>
    </form>
</x-guest-layout>
