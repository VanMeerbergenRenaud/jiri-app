<x-guest-layout>
    <!-- Session Status -->
    <x-breeze.auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="form">
        @csrf

        <!-- Warning -->
        <p class="form__text">
            {{ __('Mot de passe oublié ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation du mot de passe qui vous permettra d’en choisir un nouveau.') }}
        </p>

        <!-- Email Address -->
        <div>
            <x-breeze.input-label for="email" :value="__('Email')" />
            <x-breeze.text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-breeze.input-error :messages="$errors->get('email')" />
        </div>

        <div class="form__footer">
            <button type="submit">
                {{ __('Réinitialiser mon mot de passe')}}
            </button>
        </div>
    </form>
</x-guest-layout>
