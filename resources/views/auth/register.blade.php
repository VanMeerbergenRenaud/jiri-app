<x-guest-layout>
    <h1 class="title">
        {{ __("Veuillez vous enregistrer et créer votre nouveau compte ci-dessous 👇🏻.") }}
    </h1>
    <form method="POST" action="{{ route('register') }}" class="form">
        @csrf

        <!-- Name -->
        <x-form.field
            label="Nom"
            name="name"
            type="text"
            placeholder="John Doe"
            autocomplete="name"
            required
            :messages="$errors->get('name')"
            autofocus
        />

        <!-- Email address -->
        <x-form.field
            label="Adresse mail"
            name="email"
            type="email"
            placeholder="john.doe@gmail.com"
            autocomplete="email"
            required
            :messages="$errors->get('email')"
        />

        <!-- Password -->
        <x-form.field-password
            label="Mot de passe"
            name="password"
            type="password"
            placeholder="Min. 8 caractères"
            autocomplete="new-password"
            required
            :messages="$errors->get('password')"
        />

        <!-- Confirm password -->
        <x-form.field-password
            label="Confirmation du mot de passe"
            name="password_confirmation"
            type="password"
            placeholder="Confirmer votre mot de passe"
            autocomplete="new-password"
            required
            :messages="$errors->get('password')"
        />

        <div class="form__footer">
            <a href="{{ route('login') }}">
                {{ __('Déjà enregistré ?') }}
            </a>

            <button type="submit">
                {{ __('S‘enregistrer') }}
            </button>
        </div>
    </form>
</x-guest-layout>
