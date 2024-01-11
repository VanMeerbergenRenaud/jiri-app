<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-breeze.input-label for="name" :value="__('Nom')" />
            <x-breeze.text-input id="name" class="block mt-1 w-full p-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-breeze.input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-breeze.input-label for="email" :value="__('Adresse mail')" />
            <x-breeze.text-input id="email" class="block mt-1 w-full p-2" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-breeze.input-label for="password" :value="__('Mot de passe')" />

            <x-breeze.text-input id="password" class="block mt-1 w-full p-2"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

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

        <div class="flex items-center justify-end mt-8">
            <a class="font-semibold underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà enregistré ?') }}
            </a>

            <x-breeze.primary-button class="ml-6">
                {{ __('S‘enregistrer') }}
            </x-breeze.primary-button>
        </div>
    </form>
</x-guest-layout>
