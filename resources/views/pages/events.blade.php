<x-app-layout>
    <main class="mainEvents">
        <div class="contacts__intro">
            <livewire:header
                :title="'Bonjour ' . $user->name"
                :message="'Voici ci-dessous la liste de tous vos contacts.'"
            />
            <livewire:events.add-event-dialog @added="$refresh" />
        </div>

        {{-- Liste des épreuves --}}
        <div class="events">
            <livewire:events.show-events />
        </div>
    </main>
</x-app-layout>
