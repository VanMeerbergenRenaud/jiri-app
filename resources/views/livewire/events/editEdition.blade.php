<x-app-layout>
    <main class="mainEventEdit">
        <div class="events__intro">
            <livewire:welcome-message
                :title="'Bonjour ' . $user->name . ' !'"
                :message="'Votre épreuve ' . $event->name . '  est en cours d‘acheminement.'"
            />
        </div>

        {{-- First Table for students --}}
        <div class="students">
            <div class="students__header flex justify-between">
                <h3>Ajouter des évalués</h3>
                {{-- Input to search the students in filter the next table --}}
                <label for="search">
                    @include('components.svg.search')
                    <input
                        type="search"
                        name="search"
                        id="search"
                        placeholder="Rechercher un étudiant"
                        wire:model="search"
                        class="typeSearch"
                    >
                </label>
                {{-- Result list of the students from the search field --}}
                {{--<ul>
                    @foreach($students as $student)
                        <li>
                            <img src="" alt="Photo de {{ $student->name }}">
                            {{ $student->name }}
                        </li>
                    @endforeach
                </ul>--}}
            </div>

            <form method="POST" action="/students">
                @csrf
                @method('POST')
                <table class="students__table">
                    {{-- 7 colonnes : Nom, prénom, photo, projets, catégories, modification, supprimer --}}
                    <thead>
                        <tr class="students__table__row1">
                            <th scope="col" class="firstname">Nom</th>
                            <th scope="col" class="lastname">Prénom</th>
                            <th scope="col" class="photo">Photo</th>
                            <th scope="col">Projets</th>
                            <th scope="col">Catégories</th>
                            <th scope="col">Modification</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Row to create a student --}}
                        <tr class="students__table__row2">
                            {{-- Name {{ $student->name }} --}}
                            <td>
                               <div>
                                   <label for="name">
                                       <input type="text" name="name" id="name" placeholder="Nom">
                                   </label>
                               </div>
                            </td>
                            {{-- Firstname {{ $student->firstname }} --}}
                            <td>
                                <div>
                                    <label for="firstname">
                                        <input type="text" name="firstname" id="firstname" placeholder="Prénom">
                                    </label>
                                </div>
                            </td>
                            {{-- Photo --}}
                            <td>
                                <div>
                                    <label for="photo" x-data="{ files: null }" class="file">
                                        <input type="file" name="photo" id="photo" x-on:change="files = Object.values($event.target.files)">
                                        @include('components.svg.upload-file')
                                        <span x-text="files ? files.map(file => file.name).join(', ') : 'JPEG, JPG, PNG only'"></span>
                                    </label>
                                </div>
                            </td>
                            {{-- Projects --}}
                            <td>
                                <div class="projects">
                                    <label for="project">
                                        <input type="checkbox" name="project" id="project">
                                        Portfolio
                                    </label>
                                    <label for="project2">
                                        <input type="checkbox" name="project2" id="project2">
                                        Site client
                                    </label>
                                </div>
                            </td>
                            {{-- Categories --}}
                            <td>
                                <div class="categories">
                                    <label for="category">
                                        <input type="checkbox" name="category" id="category">
                                        Design
                                    </label>
                                    <label for="category2">
                                        <input type="checkbox" name="category2" id="category2">
                                        Intégration
                                    </label>
                                </div>
                            </td>
                            {{-- Edit button --}}
                            <td>
                                <div class="editButton">
                                    <button type="submit">Sauvegarder</button>
                                    {{--<button>Modifier</button>
                                    <button>Valider</button>--}}
                                </div>
                            </td>
                            {{-- Delete --}}
                            <td>
                                <div class="deleteButton">
                                    <button>
                                        @include('components.svg.trash2')
                                    </button>
                                </div>
                            </td>
                        </tr>
                        {{-- Row to add a button that allow to add a new student --}}
                        <tr class="students__table__row3">
                            <td colspan="7">
                                <div class="addButton">
                                    {{-- Add a row to create a student --}}
                                    <button>
                                        Ajouter un étudiant
                                        @include('components.svg.add')
                                    </button>
                                </div>
                            </td>
                    </tbody>
                </table>
            </form>
        </div>

        {{-- Second Table for evaluators --}}

        {{-- List of contacts --}}
    </main>
</x-app-layout>
