<x-guest-layout>

    @if (session('status') == 'verification-link-sent')
        <p>
            {{ __("Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de votre enregistrement.") }}
        </p>
    @endif

    <div class="forms">
        <form method="POST" action="{{ route('verification.send') }}" class="form">
            @csrf

            <p class="form__text">
                {{ __("Merci de vous être enregistré ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu l'e-mail, nous vous en enverrons un autre avec plaisir.") }}
            </p>

            <div class="form__footer">
                <button type="submit">
                    {{ __('Renvoyer le lien de vérification') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="form">
            @csrf

            <button type="submit">
                {{ __('Se déconnecter') }}
            </button>
        </form>
    </div>
</x-guest-layout>
