<x-app-layout>
    <main class="mainEventEdit">
        <div class="events__intro">
            <livewire:welcome-message
                :title="'Bonjour ' . $user->name"
                :message="'Votre épreuve ' . 'Jury' . ' est en cours d’acheminement.'"
            />
        </div>

        <div class="event__edit">
            <h3>Edit event</h3>
        </div>
    </main>
</x-app-layout>
