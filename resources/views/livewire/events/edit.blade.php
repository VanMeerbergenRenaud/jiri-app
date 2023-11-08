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
                        <div class="custom__dropdown">
                            <div x-data="{ open: false }">
                                <button x-on:click="open = !open" type="button" class="button">
                                    Sélectionner un contact
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div x-show="open" x-on:click.outside="open = false" class="panel">
                                    @livewire('users-list')
                                    <button class="add-button">Ajouter un contact</button>
                                </div>
                            </div>
                        </div>

                        <div class="form__component__added">
                            <p>Contacts ajoutés</p>
                            <ul>
                                <li>
                                    <span class="category">Étudiant</span>
                                    <span class="username">Renaud Van Meerbergen</span>
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
                                    <span class="category">Membre du jury</span>
                                    <span class="username">Daniel Schreurs</span>
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
                    <button class="button button--classic" type="submit">Sauvegarder</button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
