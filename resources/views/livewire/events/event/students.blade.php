<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Évènement {{  $event->name ?? 'ok' }}</h1>
    @endsection

    <header class="header">
        <x-banner
            title="Étudiants de l'épreuve"
            message="Les évalués de l'épreuve"
        />
    </header>

    <main>

    </main>
</div>
