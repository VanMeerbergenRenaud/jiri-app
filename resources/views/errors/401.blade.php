<x-app-layout>
    <main class="p-error">
        <div class="p-error__header">
            <h1 class="p-error__code">
                <span class="sr-only">Page d'erreur</span>
                401
            </h1>
            <h2 class="p-error__title">Page non autorisée…</h2>
            <p class="p-error__description">
                Vous essayez d'accéder une page à laquelle vous n'avez pas le droit d'accéder&nbsp;!<br>
                Ne tentez pas de passer par la fenêtre, vous n'y arriverez pas&nbsp;!
            </p>
            <a href="{{ url()->previous() }}" class="p-error__button">
                {{ __('Retourner à la page précédente') }}
            </a>
        </div>
    </main>
</x-app-layout>
