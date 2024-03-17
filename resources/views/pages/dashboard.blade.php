<x-app-layout>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Dashboard de l'administrateur</h1>
    @endsection

    <main class="mainDashboard max-width">
        <h2 role="heading" aria-level="2">Salut {{ $user->name }} !</h2>
        <p>Bienvenue sur votre tableau de bord. Vous pouvez voir ici un aperçu de vos dernières statistiques.</p>

        <!-- Stats -->
        <div>
            <p>
                Évènements créés au total en tant qu'organisateur :
                @if(auth()->user()->events->count() > 0)
                    {{ auth()->user()->events->count() }}
                @else
                    aucun 😳
                @endif
            </p>
        </div>
    </main>
</x-app-layout>
