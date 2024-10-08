{{-- FormNewContact to edit an event --}}
<div>
    <form wire:submit.prevent="save" class="form">
        @csrf

        {{-- Label & input for name, date of beginning and end of the event --}}
        <div class="form__event-infos">
            <x-form.field
                name="name"
                label="Nom de l'épreuve"
                type="text"
                model="form.name"
                placeholder="Nom de l'épreuve"
            />

            <x-form.field
                label="Date de début"
                name="starting_at"
                type="datetime-local"
                model="form.starting_at"
                min="2020-01-01T00:00"
                max="2038-01-01T00:00"
                placeholder="{{ now()->format('Y-m-d\TH:i') }}"
            />

            <x-form.field
                label="Durée de l'épreuve"
                name="duration"
                type="time"
                model="form.duration"
                min="00:01:00"
                max="23:59:00"
                placeholder="00:00:00"
            />
        </div>

        <div class="form__container">
            {{-- Label & select to edit a user in the database --}}
            <div class="form__component">
                <h3 role="heading" aria-level="3" class="title">Ajouter des contacts</h3>
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

                        {{-- SearchListContact & FormNewContact --}}
                        <div class="filter__contacts"
                             x-data="{
                                 createmode: false,
                                 username: ''}
                                 "
                        >

                            <livewire:events.edit.search-list-contact :event="$event" />
                            <livewire:events.edit.form-new-contact :event="$event" />

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
                <livewire:events.edit.added-list-contact :event="$event" />
            </div>

            {{-- Label & select to edit a project in the database --}}
            <div class="form__component">
                <h3 role="heading" aria-level="3" class="title">Ajouter des projets</h3>
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

                        {{-- SearchListContact & FormNewContact --}}
                        <div class="filter__contacts" x-data="{createmode: false}">

                            <livewire:events.edit.search-list-project :event="$event" />
                            <livewire:events.edit.form-new-project :event="$event" />

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
                <livewire:events.edit.added-list-project :event="$event" />
            </div>

            {{-- Pondération --}}
            <livewire:events.edit.ponderation :event="$event" />
        </div>

        {{-- Submit buttons --}}
        <div class="form__submit">
            <a href="{{ route('events.index') }}" class="save" title="Retourner à la liste des épreuves">Annuler</a>
            <button class="cancel" type="submit">Sauvegarder</button>
        </div>
    </form>
</div>
