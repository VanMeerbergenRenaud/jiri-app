<x-app-layout>
    <main class="error-404">
        <div class="error-404__header">
            <p class="error-404__code">404</p>
            <h1 class="error-404__title">Page non trouvée...</h1>
            <p class="error-404__description">
                Désolé mon bro, je n'ai pas su trouver la page que tu cherches...
            </p>
            <a href="{{ route('dashboard') }}" class="error-404__button">
                {{ __('Retourner à l‘accueil') }}
            </a>
        </div>
    </main>
</x-app-layout>
