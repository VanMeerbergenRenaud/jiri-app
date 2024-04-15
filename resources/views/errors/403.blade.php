<x-app-layout>
    <main class="error">
        <div class="error__header">
            <h1 class="error__code">
                <span class="sr-only">Page d'erreur</span>
                403
            </h1>
            <h2 class="error__title">Page interdite…</h2>
            <p class="error__description">
                Vous essayez d'accéder une page à laquelle vous n'avez pas le droit d'accéder&nbsp;!<br>
                Bien essayer, petit chenapan&nbsp;!
            </p>
            <a href="{{ route('dashboard') }}" class="error__button">
                {{ __('Retourner à l‘accueil') }}
            </a>
        </div>
    </main>
</x-app-layout>
