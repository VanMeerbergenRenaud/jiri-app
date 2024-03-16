<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="form">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form__field">
            <x-breeze.input-label for="email" :value="__('Adresse mail')" />
            <x-breeze.text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autocomplete="username" autofocus />
            <x-breeze.input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="form__field">
            <x-breeze.input-label for="password" :value="__('Mot de passe')" />
            <x-breeze.text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="form__field">
            <x-breeze.input-label for="password_confirmation" :value="__('Confirmation du mot de passe')" />
            <x-breeze.text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="form__footer">
            <button type="submit">
                {{ __('Réinitialiser le mot de passe') }}
            </button>
        </div>
    </form>
</x-guest-layout>
