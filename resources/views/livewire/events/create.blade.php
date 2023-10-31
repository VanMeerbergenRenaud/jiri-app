<x-app-layout>
    <main class="main-event-create">
        {{-- Component Start --}}
        <div class="events__infos">
            <div class="welcome__start__infos">
                <img src="{{ asset('img/dominique.png') }}" alt="Image de l'admin Dominique">
                <div>
                    <h2>Bonjour Dominique !</h2>
                    <p>Découvrez la liste des diverses épreuves à venir ou déjà passées.</p>
                </div>
            </div>
        </div>
        <div class="event-create">
            {{-- Form to create a event --}}
            <form
                action="{{ route('events.store') }}"
                method="POST"
                class="form"
            >
                {{-- Label & input for name, date of beginning and end of the event --}}
                <div class="form__infos">
                    <label for="name">Nom de l'épreuve</label>
                    <p>
                        Date et durée de l’épreuve
                        <label for="date_start" class="sr-only">Date de début</label>
                        <label for="date_end" class="sr-only">Date de fin</label>
                    </p>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Ex : Design Web"
                    >
                    @error('name')<p>{{ $message }}</p>@enderror
                    <input
                        type="date"
                        name="date_start"
                        id="date_start"
                    >
                    @error('date_start')<p>{{ $message }}</p>@enderror
                    <input
                        type="date"
                        name="date_end"
                        id="date_end"
                    >
                    @error('date_end')<p>{{ $message }}</p>@enderror
                </div>
                <div class="form__container">
                    {{-- Label & select to create a user in the database --}}
                    <div class="form__component">
                        <h4>Ajouter des contacts</h4>
                        <p>Vous pourrez en ajouter encore par la suite sans problème.</p>
                        <label for="user_id" class="sr-only">Ajout d'un contact</label>
                        <select name="user_id" id="user_id">
                            <option value="0">Sélectionner un contact</option>
                            <option value="1">Renaud Van Meerbergen</option>
                            <option value="2">Dominique Vilain</option>
                        </select>

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
                    <button>Annuler</button>
                    <button class="button--classic">Créer</button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
