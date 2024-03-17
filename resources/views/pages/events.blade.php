<x-app-layout>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Évènements de l'administrateur</h1>
    @endsection

    <header class="header">
        <x-banner
            :title="'Liste de vos épreuves'"
            :message="'Voici ci-dessous la liste de tous vos évènements.'"
        />
        <livewire:events.add-event-dialog />
    </header>

    <main class="mainEvents max-width">
        <div class="events">
            <livewire:events.show-events />
        </div>
    </main>
</x-app-layout>
