<x-guest-layout>
    <h1 class="title">
        {{ __("Veuillez vous connecter à votre compte rapidement juste ici 👇🏻.") }}
    </h1>

    <!-- Session Status -->
    <x-breeze.auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf

        <!-- Email Address -->
        <div class="form__field">
            <x-breeze.input-label for="email" :value="__('Email')" />
            <x-breeze.text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" autofocus />
            <x-breeze.input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="form__field">
            <x-breeze.input-label for="password" :value="__('Mot de passe')" />
            <x-breeze.text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-breeze.input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="form__field form__remember-me">
            <x-breeze.text-input id="remember_me" type="checkbox" name="password"/>
            <x-breeze.input-label for="remember_me" :value="__('Se rappeler de moi')" />
        </div>

        <div class="form__footer form__footer__3">
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

            <button type="submit" class="submit">
                {{ __('Se connecter') }}
            </button>
        </div>
    </form>
</x-guest-layout>
