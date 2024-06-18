<x-guest-layout>
    <h1 class="title">
        {{ __("Veuillez vous connecter à votre compte rapidement juste ici 👇🏻.") }}
    </h1>

    <!-- Session Status -->
    <x-auth.session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf

        <!-- Email Address -->
        <x-form.field
            label="Adresse mail"
            name="email"
            type="email"
            placeholder="john.doe@gmail.com"
            autocomplete="username"
            required
            :messages="$errors->get('email')"
            autofocus
        />

        <!-- Password -->
        <x-form.field-password
            label="Mot de passe"
            name="password"
            placeholder="Min. 8 caractères"
            autocomplete="current-password"
            required
            :messages="$errors->get('password')"
        />

        <!-- Remember Me -->
        <div class="form__field form__remember-me">
            <input id="remember_me" type="checkbox" name="password"/>
            <label for="remember_me">{{  __('Se rappeler de moi') }}</label>
        </div>

        <div class="form__footer form__footer__4">
            @if (Route::has('register'))
                <a href="{{ route('register') }}">
                    {{ __("Pas encore enregistré") }}&nbsp;?
                </a>
            @endif

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __("Mot de passe oublié") }}&nbsp;?
                </a>
            @endif

            <x-auth.github-login />

            <button type="submit" class="submit">
                {{ __('Se connecter') }}
            </button>
        </div>
    </form>
</x-guest-layout>
