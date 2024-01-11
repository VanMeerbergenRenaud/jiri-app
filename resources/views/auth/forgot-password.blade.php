<x-guest-layout>
    <div class="mb-4 text-sm text-gray-700">
        {{ __('Mot de passe oublié ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation du mot de passe qui vous permettra d’en choisir un nouveau.') }}
    </div>

    <!-- Session Status -->
    <x-breeze.auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-breeze.input-label for="email" :value="__('Email')" />
            <x-breeze.text-input id="email" class="block mt-1 w-full p-2" type="email" name="email" :value="old('email')" required autofocus />
            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-breeze.primary-button>
                {{ __('Lien de réinitialisation du mot de passe')}}
            </x-breeze.primary-button>
        </div>
    </form>
</x-guest-layout>
