<x-app-layout>
    <main class="mainEventsCreate">
        <div class="events__intro">
            <livewire:header
                :title="'Bonjour ' . $user->name . ' !'"
                :message="'C’est parti pour une nouvelle expérience !'"
            />
        </div>

        <div class="events__create">
            {{-- Form to create a event --}}
            <form
                action="{{ route('events.store') }}"
                method="POST"
                class="form"
            >
                @csrf
                {{-- Label & input for name, date of beginning and end of the event --}}
                <div class="form__infos">
                    <x-form.input
                        type="text"
                        name="name"
                        id="name"
                        min="1"
                        placeholder="Ex : Design Web"
                        value="{{ old('name') }}"
                        label="Nom de l'épreuve"
                    />

                    <x-form.input
                        type="datetime-local"
                        name="starting_at"
                        id="starting_at"
                        min="2023-01-01T00:00"
                        max="3000-01-01T00:00"
                        placeholder="Ex : 2021-01-01T00:00"
                        value="{{ old('starting_at') ?? date('Y-m-d\TH:i', strtotime('+1 hour')) }}"
                        label="Date de début"
                    />

                    <x-form.input
                        type="number"
                        name="duration"
                        id="duration"
                        min="1"
                        max="480"
                        placeholder="Ex : 1"
                        value="{{ old('duration', 1) }}"
                        label="Durée de l'épreuve"
                    />
                </div>

                <br>

                <div class="form__submit">
                    <a href="{{ route('events.index') }}" wire:navigate class="button">Annuler</a>
                    <button class="button button--classic" type="submit">Créer</button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
