<x-app-layout>
    <main class="error">
        <div class="error__header">
            <h1 class="error__code">
                <span class="sr-only">Page d'erreur</span>
                401
            </h1>
            <h2 class="error__title">Page non autorisée…</h2>
            <p class="error__description">
                Vous essayez d'accéder une page à laquelle vous n'avez pas le droit d'accéder&nbsp;!<br>
                Ne tentez pas de passer par la fenêtre, vous n'y arriverez pas&nbsp;!
            </p>
            <a href="{{ route('dashboard') }}" class="error__button">
                {{ __('Retourner à l‘accueil') }}
            </a>
        </div>
    </main>
</x-app-layout>
