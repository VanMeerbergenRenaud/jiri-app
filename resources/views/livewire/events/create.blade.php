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
                    >
                    <input
                        type="datetime-local"
                        name="starting_at"
                        id="starting_at"
                        min="2023-01-01T00:00"
                        max="3000-01-01T00:00"
                        value="{{ old('starting_at') ?? date('Y-m-d\TH:i', strtotime('+1 hour')) }}"
                    >
                    <input
                        type="number"
                        name="duration"
                        id="duration"
                        min="1"
                        max="480"
                        value="{{ old('duration', 1) }}"
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
                        <div class="custom__dropdown" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button" class="button">
                                    Sélectionner un contact
                                    @include('components.svg.arrow-down')
                                </button>
                                <div x-show="open" @click.outside="open = false" class="panel">
                                    @livewire('users-list')
                                    <button class="add-button">Ajouter un contact</button>
                                </div>
                            </div>
                        </div>

                        <div class="form__component__added">
                            @livewire('contacts-list')
                            <p>Contacts ajoutés</p>
                            <ul>
                                @foreach($users as $contact)
                                    <li>
                                        <span class="category">{{ $contact->category }}</span>
                                        <span class="username">{{ $contact->name }}</span>
                                        <button>
                                            @include('components.svg.trash2')
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{-- Label & select to create a project in the database --}}
                    <div class="form__component">
                        <h4>Ajouter des projets</h4>
                        <p>Vous pourrez en ajouter encore par la suite sans problème.</p>
                        <label for="project_id" class="sr-only">Ajout d'un projet</label>
                        <select name="project_id" id="project_id">
                            <option value="0">Sélectionner un projet</option>
                            <option value="1">Projet 1</option>
                            <option value="2">Projet 2</option>
                        </select>

                        <div class="form__component__added">
                            <p>Projets ajoutés</p>
                            <ul>
                                <li>
                                    <span class="category">Portfolio</span>
                                    <span class="username">Design | Intégration | Wordpress</span>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18.2" height="20" viewBox="0 0 18.2 20">
                                            <g transform="translate(1 1)">
                                                <path d="M4.5,9H20.7" transform="translate(-4.5 -2.25)" fill="none" stroke="#656b7e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                                <path d="M17.7,6.6V19.2A1.656,1.656,0,0,1,16.243,21H8.957A1.656,1.656,0,0,1,7.5,19.2V6.6m2.186,0V4.8A1.656,1.656,0,0,1,11.143,3h2.914a1.656,1.656,0,0,1,1.457,1.8V6.6" transform="translate(-4.5 -3)" fill="none" stroke="#656b7e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                            </g>
                                        </svg>
                                    </button>
                                </li>
                                <li>
                                    <span class="category">Site client</span>
                                    <span class="username">Design | Intégration</span>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18.2" height="20" viewBox="0 0 18.2 20">
                                            <g id="Icon_feather-trash" data-name="Icon feather-trash" transform="translate(1 1)">
                                                <path id="Tracé_68" data-name="Tracé 68" d="M4.5,9H20.7" transform="translate(-4.5 -2.25)" fill="none" stroke="#656b7e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                                <path id="Tracé_69" data-name="Tracé 69" d="M17.7,6.6V19.2A1.656,1.656,0,0,1,16.243,21H8.957A1.656,1.656,0,0,1,7.5,19.2V6.6m2.186,0V4.8A1.656,1.656,0,0,1,11.143,3h2.914a1.656,1.656,0,0,1,1.457,1.8V6.6" transform="translate(-4.5 -3)" fill="none" stroke="#656b7e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                            </g>
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </div>
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
