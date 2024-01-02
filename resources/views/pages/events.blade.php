<x-app-layout>
    <header class="header">
        <x-header
            :title="'Liste de vos épreuves'"
            :message="'Voici ci-dessous la liste de tous vos contacts.'"
        />
        <livewire:events.add-event-dialog />
    </header>

    <main class="mainEvents">
        {{-- Liste des épreuves --}}
        <div class="events">
            <livewire:events.show-events />
        </div>
    </main>
</x-app-layout>
