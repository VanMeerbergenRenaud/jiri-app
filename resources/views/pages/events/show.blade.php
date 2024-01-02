<x-app-layout>
    <header class="header">
        <x-header
            :title="'Épreuve en cours'"
            :message="'Votre épreuve ' . $event->name . '  vient de commencer.'"
        />
    </header>

    <main class="mainEventShow">
        {{-- First Table --}}
        <div class="event__show">
            <livewire:events.show.first-table />
        </div>

        {{-- Second Table --}}
        <div class="event__show__results">
            <h2 class="title">Tableau de résumé des cotes</h2>
            <livewire:events.show.second-table />
        </div>
    </main>
</x-app-layout>
