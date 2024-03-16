<x-guest-layout>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez fournie lors de votre enregistrement.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}" class="form">
            @csrf

            <p class="form__text">
                {{ __('Merci de vous être enregistré ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n\'avez pas reçu l\'e-mail, nous vous en enverrons un autre avec plaisir.') }}
            </p>

            <div class="form__footer">
                <button type="submit">
                    {{ __('Renvoyer le lien de vérification') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="form">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Se déconnecter') }}
            </button>
        </form>
    </div>
</x-guest-layout>
