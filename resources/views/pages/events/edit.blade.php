<x-app-layout>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Édition de l'évènement</h1>
    @endsection

    <header class="header">
        <x-banner
            :title="'Configuration de l‘épreuve'"
            :message="'Votre épreuve ' . $event->name . '  est en cours d‘acheminement.'"
        />
    </header>

    <main class="mainEventsCreate">
        <livewire:events.edit.container :event="$event" />
    </main>
</x-app-layout>
