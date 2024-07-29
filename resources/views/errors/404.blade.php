<x-evaluator-layout>
    <main class="p-error">
        <div class="p-error__header">
            <h1 class="p-error__code">
                <span class="sr-only">Page d'erreur</span>
                404
            </h1>
            <h2 class="p-error__title">Page non trouvée…</h2>
            <p class="p-error__description">
                Navrez de vous voir ici, vous essayez d'accéder une page introuvable&nbsp;!
            </p>
            <a href="{{ url()->previous() }}" class="p-error__button">
                {{ __('Retourner à la page précédente') }}
            </a>
        </div>
    </main>
</x-evaluator-layout>
