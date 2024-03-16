<x-guest-layout>
    <form method="POST" action="{{ route('password.confirm') }}" class="form">
        @csrf

        <!-- Warning -->
        <p class="form__text">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>

        <!-- Password -->
        <div>
            <x-breeze.input-label for="password" :value="__('Password')" />
            <x-breeze.text-input id="password" type="password" name="password" required autocomplete="current-password" autofocus />
            <x-breeze.input-error :messages="$errors->get('password')" />
        </div>

        <div class="form__footer">
            <button type="submit">
                {{ __('Confirmer') }}
            </button>
        </div>
    </form>
</x-guest-layout>
