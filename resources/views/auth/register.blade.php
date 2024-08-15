<x-guest-layout>
    <h1 role="heading" aria-level="1" class="title">
        {{ __("Veuillez vous enregistrer et créer votre nouveau compte ci-dessous 👇🏻.") }}
    </h1>

    <form method="POST" action="{{ route('register') }}" class="form">
        @csrf

        <!-- Name -->
        <x-form.breeze-field
            label="Nom"
            name="name"
            type="text"
            placeholder="John Doe"
            autocomplete="name"
            required
            autofocus
            :messages="$errors->get('name')"
        />

        <!-- Email address -->
        <x-form.breeze-field
            label="Adresse mail"
            name="email"
            type="email"
            placeholder="john.doe@gmail.com"
            autocomplete="username"
            required
            :messages="$errors->get('email')"
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
            placeholder="Confirmer pour être sûre"
            autocomplete="new-password"
            required
            :messages="$errors->get('password')"
        />

        <div class="form__footer">
            <a href="{{ route('login') }}" title="Vers la page de connexion">
                {{ __('Déjà enregistré ?') }}
            </a>

            <div class="form__footer__login">
                <x-auth.github-login />

                <button type="submit">
                    {{ __('S‘enregistrer') }}
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>
