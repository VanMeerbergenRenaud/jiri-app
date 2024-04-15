<x-app-layout>
    <main class="error">
        <div class="error__header">
            <h1 class="error__code">
                <span class="sr-only">Page d'erreur</span>
                404
            </h1>
            <h2 class="error__title">Page non trouvée…</h2>
            <p class="error__description">
                Navrez de vous voir ici, vous essayez d'accéder une page introuvable&nbsp;!
            </p>
            <a href="{{ route('dashboard') }}" class="error__button">
                {{ __('Retourner à l‘accueil') }}
            </a>
        </div>
    </main>
</x-app-layout>
