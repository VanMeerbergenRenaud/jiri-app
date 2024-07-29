<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="form">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email address -->
        <x-form.breeze-field
            label="Adresse mail"
            name="email"
            type="email"
            value="{{  old('email', $request->email) }}"
            placeholder="john.doe@gmail.com"
            autocomplete="username"
            required
            :messages="$errors->get('email')"
            autofocus
        />

        <!-- Password -->
        <x-form.breeze-field-password
            label="Mot de passe"
            name="password"
            placeholder="Min. 8 caractères"
            autocomplete="new-password"
            required
            :messages="$errors->get('password')"
        />

        <!-- Confirm password -->
        <x-form.breeze-field-password
            label="Confirmation du mot de passe"
            name="password_confirmation"
            placeholder="Confirmer votre mot de passe"
            autocomplete="new-password"
            required
            :messages="$errors->get('password')"
        />

        <div class="form__footer">
            <button type="submit">
                {{ __('Réinitialiser le mot de passe') }}
            </button>
        </div>
    </form>
</x-guest-layout>
