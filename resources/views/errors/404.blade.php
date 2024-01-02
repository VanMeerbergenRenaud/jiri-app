<x-app-layout>
    <main class="error">
        <div class="error__header">
            <p class="error__code">404</p>
            <h1 class="error__title">Page non trouvée...</h1>
            <p class="error__description">
                Désolé mon bro, je n'ai pas su trouver la page que tu cherches...
            </p>
            <a href="{{ route('dashboard') }}" class="error__button">
                {{ __('Retourner à l‘accueil') }}
            </a>
        </div>
    </main>
</x-app-layout>
