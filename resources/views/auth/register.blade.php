<x-guest-layout>
    <h1 class="title">
        {{ __("Veuillez vous enregistrer et créer votre nouveau compte ci-dessous 👇🏻.") }}
    </h1>
    <form method="POST" action="{{ route('register') }}" class="form">
        @csrf

        <!-- Name -->
        <div class="form__field">
            <x-breeze.input-label for="name" :value="__('Nom')" />
            <x-breeze.text-input id="name" type="text" name="name" :value="old('name')" required autocomplete="name" autofocus />
            <x-breeze.input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email address -->
        <div class="form__field">
            <x-breeze.input-label for="email" :value="__('Adresse mail')" />
            <x-breeze.text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-breeze.input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="form__field">
            <x-breeze.input-label for="password" :value="__('Mot de passe')" />
            <x-breeze.text-input id="password" type="password" name="password" required autocomplete="new-password"/>
            <x-breeze.input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm password -->
        <div class="form__field">
            <x-breeze.input-label for="password_confirmation" :value="__('Confirmation du mot de passe')" />
            <x-breeze.text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->get('password_confirmation')" />
        </div>

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
