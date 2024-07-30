<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Étudiants de l'évènement {{  $event->name ?? '' }}</h1>
    @endsection

    <header class="header">
        <x-banner
            title="Étudiants de l'épreuve"
            message="Les évalués de l'épreuve"
        />
    </header>

    <main class="p-main">
        À faire (design sur xd)
    </main>

    <footer class="footerEvent">
        <p>Tableau de bord de {{ auth()->user()->name ?? 'John Doe' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve du jour' }}</p>
    </footer>
</div>
