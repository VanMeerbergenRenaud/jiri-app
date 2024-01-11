<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-breeze.input-label for="email" :value="__('Adresse mail')" />
            <x-breeze.text-input id="email" class="block mt-1 w-full p-2" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-breeze.input-label for="password" :value="__('Mot de passe')" />
            <x-breeze.text-input id="password" class="block mt-1 w-full p-2" type="password" name="password" required autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-breeze.input-label for="password_confirmation" :value="__('Confirmation du mot de passe')" />

            <x-breeze.text-input id="password_confirmation" class="block mt-1 w-full p-2"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-breeze.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-breeze.primary-button>
                {{ __('Réinitialiser le mot de passe') }}
            </x-breeze.primary-button>
        </div>
    </form>
</x-guest-layout>
