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
                    <label for="name">Nom de l'épreuve</label>
                    <label for="starting_at">Date de début</label>
                    <label for="duration">Durée de l'épreuve</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        min="1"
                        placeholder="Ex : Design Web"
                        value="{{ old('name') }}"
                        dusk="name"
                    >
                    <input
                        type="datetime-local"
                        name="starting_at"
                        id="starting_at"
                        min="2023-01-01T00:00"
                        max="3000-01-01T00:00"
                        value="{{ old('starting_at') ?? date('Y-m-d\TH:i', strtotime('+1 hour')) }}"
                        dusk="starting_at"
                    >
                    <input
                        type="number"
                        name="duration"
                        id="duration"
                        min="1"
                        max="480"
                        value="{{ old('duration', 1) }}"
                        dusk="duration"
                    >
                    @error('name')<p class="error-message error1">{{ $message }}</p>@enderror
                    @error('starting_at')<p class="error-message error2">{{ $message }}</p>@enderror
                    @error('duration')<p class="error-message error3">{{ $message }}</p>@enderror
                </div>

                <div class="form__container">
                    {{-- Label & select to create a user in the database --}}
                    <div class="form__component">
                        <h4>Ajouter des contacts</h4>
                        <p>Vous pourrez en ajouter encore par la suite sans problème.</p>

                        {{-- Dropdown --}}
                        <div class="custom__dropdown"
                             x-data="{ open: false }"
                             x-init="$watch('open', value => {
                                if (value) {
                                    setTimeout(() => {
                                        document.getElementById('username').focus();
                                    }, 0);
                                }
                            });"
                        >
                            {{-- Open button --}}
                            <button @click="open = true" type="button" class="open-button">
                                Sélectionner un contact
                                @include('components.svg.arrow-down')
                            </button>

                            {{-- Panel --}}
                            <div x-show="open" class="panel">

                                {{-- Close button --}}
                                <button @click="open = false" type="button" class="close-button">
                                    @include('components.svg.cross')
                                </button>

                                {{-- SearchList & Form --}}
                                <div class="filter__contacts" x-data="{createmode: false}">

                                    <livewire:events.create.search-list :eventId="$event->id" />
                                    <livewire:events.create.form />

                                    {{-- Button to create a new contact --}}
                                    <button type="button"
                                            class="add-button"
                                            x-show="!createmode"
                                            @click="createmode = true">
                                        Ajouter un contact
                                    </button>

                                </div>
                            </div>
                        </div>

                        {{-- Added contacts --}}
                        <livewire:events.create.added-list :eventId="$event->id" />
                    </div>

                    {{-- Label & select to create a project in the database --}}
                    <div class="form__component">
                        <h4>Ajouter des projets</h4>
                        <p>Vous pourrez en ajouter encore par la suite sans problème.</p>

                        {{-- Dropdown --}}
                        <div class="custom__dropdown" x-data="{ open: false }">
                            {{-- Open button --}}
                            <button @click="open = true" type="button" class="open-button">
                                Sélectionner un projet
                                @include('components.svg.arrow-down')
                            </button>

                            {{-- Panel --}}
                            <div x-show="open" class="panel">

                                {{-- Close button --}}
                                <button @click="open = false" type="button" class="close-button">
                                    @include('components.svg.cross')
                                </button>

                                {{-- SearchList & Form --}}
                                <div class="filter__contacts" x-data="{createmode: false}">

                                    <livewire:events.create.search-list :eventId="$event->id" />
                                    <livewire:events.create.form_project />

                                    {{-- Button to create a new contact --}}
                                    <button type="button"
                                            class="add-button"
                                            x-show="!createmode"
                                            @click="createmode = true">
                                        Ajouter un projet
                                    </button>

                                </div>
                            </div>
                        </div>

                        {{-- Added projects --}}
                        <livewire:events.create.added-list :eventId="$event->id" />
                    </div>
                </div>
                <div class="form__submit">
                    <a href="{{ route('events.index') }}" class="button">Annuler</a>
                    <button class="button button--classic" type="submit">Créer</button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
