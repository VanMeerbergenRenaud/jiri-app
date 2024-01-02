<x-app-layout>
    <header class="header">
        <x-header
            :title="'Configuration de l‘épreuve'"
            :message="'Votre épreuve ' . $event->name . '  est en cours d‘acheminement.'"
        />
    </header>

    <main class="mainEventEdit mainEventsCreate">
        <livewire:events.edit.container :event="$event" />
    </main>
</x-app-layout>
