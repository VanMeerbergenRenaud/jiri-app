<x-app-layout>
    <main class="mainEventsCreate">
        <div class="events__intro">
            <livewire:welcome-message
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

                {{-- Name, date and duration of the event --}}
                @include('components.event.event-create-infos')

                {{-- Container (contacts, projects) --}}
                <div class="form__container">

                    {{-- Add contacts in the event --}}
                    <livewire:events.create.contact.container />

                    {{-- TODO : Add projects in the event--}}
                    {{--@include('livewire.events.create.project.container')--}}
                </div>

                {{-- Final submit buttons --}}
                <div class="form__submit">
                    <a href="{{ route('events.index') }}" class="button">Annuler</a>
                    <button class="button button--classic" type="submit">Créer</button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>


