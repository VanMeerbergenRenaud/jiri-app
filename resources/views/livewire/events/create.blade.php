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

                {{--
                Etapes :
                1. DONE -> Afficher un input de type search qui permet de chercher tous les contacts dans la base de donées en fonction de chaque utilisateur
                2. DONE -> Afficher un bouton d'ajout d'un contact pour créer un nouveau contact
                3. DONE -> Afficher à coté de chaque utilisateur un bouton pour ajouter ce contact depuis notre input de type search qui affiche tous nos contacts
                4. TODO -> Afficher dans un div.container les contacts ajoutés depuis notre input de type search
                5. TODO -> Afficher un bouton pour supprimer un contact depuis notre div.container
                --}}

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
                                <div x-show="open" class="panel">
                                    @livewire('contacts-list')
                                </div>
                            </div>
                        </div>

                        {{-- Added contacts --}}
                        <div class="form__component__added">
                            <p>Contacts ajoutés</p>
                            <ul>
                                @foreach($contacts as $contact)
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

                        {{-- Dropdown --}}
                        <div class="custom__dropdown" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button" class="button">
                                    Sélectionner un projet
                                    @include('components.svg.arrow-down')
                                </button>
                                <div x-show="open" class="panel">
                                    @livewire('projects-list')
                                </div>
                            </div>
                        </div>

                        {{-- Added projects --}}
                        <div class="form__component__added">
                            <p>Projets ajoutés</p>
                            <ul>
                                @foreach($projects as $project)
                                    <li>
                                        <span class="category">{{ $project->category }}</span>
                                        <span class="username">{{ $project->name }}</span>
                                        <button>
                                            @include('components.svg.trash2')
                                        </button>
                                    </li>
                                @endforeach
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
