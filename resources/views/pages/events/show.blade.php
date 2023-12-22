<x-app-layout>
    <main class="mainEventShow">
        <div class="events__intro">
            <livewire:header
                :title="'Bonjour ' . $user->name . ' !'"
                :message="'Votre épreuve ' . $event->name . '  vient de commencer.'"
            />
        </div>

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
