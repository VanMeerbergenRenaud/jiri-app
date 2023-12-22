<x-app-layout>
    <main class="mainEventEdit">
        <div class="events__intro">
            <livewire:header
                :title="'Bonjour ' . $user->name . ' !'"
                :message="'Votre épreuve ' . $event->name . '  est en cours d‘acheminement.'"
            />
        </div>

        {{-- First Table for students --}}
        <livewire:events.edit-edition-student :students="$students" :event="$event" />

        {{-- Second Table for evaluators --}}

        {{-- List of contacts --}}
    </main>
</x-app-layout>