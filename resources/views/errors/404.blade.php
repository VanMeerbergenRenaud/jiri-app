<x-app-layout>
    <main class="error-404">
        <div class="error-404__header">
            <h1 class="error-404__code">
                <span class="sr-only">Page d'erreur</span>
                404
            </h1>
            <h2 class="error-404__title">Page non trouvée…</h2>
            <p class="error-404__description">
                Navrez de vous voir ici, vous essayez d'accéder une page introuvable&nbsp;!
            </p>
            <a href="{{ route('dashboard') }}" class="error-404__button">
                {{ __('Retourner à l‘accueil') }}
            </a>
        </div>
    </main>
</x-app-layout>
