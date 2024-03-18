<x-guest-layout>
    <!-- Session Status -->
    <x-auth.session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="form">
        @csrf

        <!-- Warning -->
        <p class="form__text">
            {{ __('Mot de passe oublié ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation du mot de passe qui vous permettra d’en choisir un nouveau.') }}
        </p>

        <!-- Email Address -->
        <x-form.field
            label="Adresse mail"
            name="email"
            type="email"
            value="{{  old('email') }}"
            placeholder="john.doe@gmail.com"
            autocomplete="email"
            required
            :messages="$errors->get('email')"
            autofocus
        />

        <div class="form__footer">
            <button type="submit">
                {{ __('Réinitialiser mon mot de passe')}}
            </button>
        </div>
    </form>
</x-guest-layout>
