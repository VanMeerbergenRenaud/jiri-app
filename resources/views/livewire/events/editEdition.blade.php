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
                        {{-- List to display every row of students registered --}}
                        @foreach($students as $index => $student)
                            <tr>
                                <td>{{ $student->lastname }}</td>
                                <td>{{ $student->firstname }}</td>
                                <td><img src="{{ $student->photo }}" alt="Photo de {{ $student->name }}"></td>
                                <td>{{ $student->projects }}</td>
                                <td>{{ $student->categories }}</td>
                                <td><button>Modifier</button></td>
                                <td><button>Supprimer</button></td>
                            </tr>
                        @endforeach

                        {{-- Row to create a new student --}}
                        

                        {{-- Row to add a button that allow to add a new student --}}
                        <tr class="students__table__row3">
                            <td colspan="7">
                                <div class="addButton">
                                    {{-- Add a row to create a student --}}
                                    <button type="button" wire:click="addStudentRow">
                                        Ajouter un étudiant
                                        @include('components.svg.add')
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        {{-- Second Table for evaluators --}}

        {{-- List of contacts --}}
    </main>
</x-app-layout>