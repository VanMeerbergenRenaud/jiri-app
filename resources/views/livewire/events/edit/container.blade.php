{{-- Form to edit an event --}}
<div>
    <form wire:submit.prevent="save" class="form">
        @csrf

        {{-- Label & input for name, date of beginning and end of the event --}}
        <div class="form__event-infos">
            <x-form.input
                type="text"
                model="form.name"
                name="name"
                min="1"
                placeholder="Nom de l'épreuve"
                label="Nom de l'épreuve"
            />

            <x-form.input
                type="datetime-local"
                model="form.starting_at"
                name="starting_at"
                min="2020-01-01T00:00"
                max="2038-01-01T00:00"
                placeholder="JJ/MM/AAAA HH:MM"
                label="Date de début"
            />

            <x-form.input
                type="time"
                model="form.duration"
                name="duration"
                min="00:01:00"
                max="23:59:59"
                placeholder="HH:MM:SS"
                label="Durée de l'épreuve"
            />
        </div>

        <div class="form__container">
            {{-- Label & select to edit a user in the database --}}
            <div class="form__component">
                <h3 class="title">Ajouter des contacts</h3>
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
                    <div x-show="open" class="open-panel">

                        {{-- Close button --}}
                        <button @click="open = false" type="button" class="close-button">
                            @include('components.svg.cross')
                        </button>

                        {{-- SearchList & Form --}}
                        <div class="filter__contacts"
                             x-data="{
                                 createmode: false,
                                 username: ''}
                                 "
                        >

                            <livewire:events.edit.search-list :eventId="$event->id" />
                            <livewire:events.edit.form />

                            {{-- Button to edit a new contact --}}
                            <button type="button"
                                    class="button--blue add-contact-button"
                                    x-show="!createmode"
                                    @click="createmode = true">
                                Ajouter un contact
                            </button>

                        </div>
                    </div>
                </div>

                {{-- Added contacts --}}
                <livewire:events.edit.added-list :eventId="$event->id" />
            </div>

            {{-- Label & select to edit a project in the database --}}
            <div class="form__component">
                <h3 class="title">Ajouter des projets</h3>
                <p>Vous pourrez en ajouter encore par la suite sans problème.</p>

                {{-- Dropdown --}}
                <div class="custom__dropdown"
                     x-data="{ open: false }"
                     x-init="$watch('open', value => {
                                if (value) {
                                    setTimeout(() => {
                                        document.getElementById('projectname').focus();
                                    }, 0);
                                }
                            });"
                >
                    {{-- Open button --}}
                    <button @click="open = true" type="button" class="open-button">
                        Sélectionner un projet
                        @include('components.svg.arrow-down')
                    </button>

                    {{-- Panel --}}
                    <div x-show="open" class="open-panel">

                        {{-- Close button --}}
                        <button @click="open = false" type="button" class="close-button">
                            @include('components.svg.cross')
                        </button>

                        {{-- SearchList & Form --}}
                        <div class="filter__contacts" x-data="{createmode: false}">

                            <livewire:events.edit.search-list-project :eventId="$event->id" />
                            <livewire:events.edit.form-project />

                            {{-- Button to edit a new contact --}}
                            <button type="button"
                                    class="button--blue add-contact-button"
                                    x-show="!createmode"
                                    @click="createmode = true">
                                Ajouter un projet
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Added projects --}}
                <livewire:events.edit.added-list-project :eventId="$event->id" />
            </div>
        </div>
        <div class="form__submit">
            <a href="{{ route('events.index') }}" class="button">Annuler</a>
            <button class="button button--blue" type="submit">Sauvegarder</button>
        </div>
    </form>
</div>
