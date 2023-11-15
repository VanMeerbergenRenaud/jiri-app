<x-app-layout>
    <main class="mainEventsCreate">
        <div class="events__intro">
            <livewire:welcome-message
                :title="'Bonjour ' . $user->name . ' !'"
                :message="'Votre épreuve ' . $event->name . ' est en cours d’acheminement.'"
            />
        </div>

        <div class="events__create">
            {{-- Form to create a event --}}
            <form
                action="{{ route('events.update', ['event' => $event]) }}"
                method="POST"
                class="form"
            >

            @csrf
            @method('PUT')
                {{-- Label & input for name, date of beginning and end of the event --}}
                <div class="form__infos">
                    <label for="name">Nom de l'épreuve</label>
                    <label for="starting_at">Date de début</label>
                    <label for="duration">Durée de l'épreuve</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Ex : Design Web"
                        value="{{ $event->name }}"
                    >
                    <input
                        type="datetime-local"
                        name="starting_at"
                        id="starting_at"
                        value="{{ \Carbon\Carbon::parse($event->starting_at)->format('Y-m-d\TH:i') }}"
                    >
                    <input
                        type="number"
                        name="duration"
                        id="duration"
                        min="1"
                        max="480"
                        value="{{ $event->duration }}"
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
                                <div class="filter__contacts"
                                     x-data="{
                                     createmode: false,
                                     username: ''}
                                     ">

                                    <livewire:events.create.search-list />
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
                        <livewire:events.create.added-list />
                    </div>

                    {{-- Label & select to create a project in the database --}}
                    <div class="form__component">
                        <h4>Ajouter des projets</h4>
                        <p>Vous pourrez en ajouter encore par la suite sans problème.</p>

                        {{-- Dropdown,... --}}
                    </div>
                </div>
                <div class="form__submit">
                    <a href="{{ route('events.index') }}" class="button">Annuler</a>
                    <button class="button button--classic" type="submit">Sauvegarder</button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
