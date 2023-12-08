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
                placeholder="Rechercher un étudiant..."
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

    <form wire:submit.prevent="save">
        @csrf
        @method('PUT')
        <table class="students__table">
            {{-- 7 colonnes : Nom, prénom, photo, projets, catégories, modification, supprimer --}}
            <thead>
            <tr class="students__table__row1">
                <th scope="col" class="firstname">Nom</th>
                <th scope="col" class="lastname">Prénom</th>
                <th scope="col" class="email">Email</th>
                <th scope="col" class="photo">Photo</th>
                <th scope="col" class="projects">Projets</th>
                <th scope="col" class="editColumn">Modification</th>
                <th scope="col" class="deleteColumn">Supprimer</th>
            </tr>
            </thead>
            <tbody>
            @if(count($students) > 0)
                @foreach($students as $index => $student)
                    <tr class="students__table__row2">
                        <td>
                            <div>
                                <label for="name">
                                    <input type="text" name="name" id="name" placeholder="Nom" wire:model="students.{{ $index }}.name" value="{{ $student->name ?? '' }}">
                                </label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <label for="firstname">
                                    <input type="text" name="firstname" id="firstname" placeholder="Prénom" wire:model="students.{{ $index }}.firstname" value="{{ $student->firstname ?? '' }}">
                                </label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <label for="email">
                                    <input type="text" name="email" id="email" placeholder="Email" wire:model="students.{{ $index }}.email" value="{{ $student->email ?? '' }}">
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
                                @foreach($projects as $project)
                                    <label for="project{{$index}}-{{ $project->id }}">
                                        <input type="checkbox" name="project{{ $project->name }}" id="project{{$index}}-{{ $project->id }}">
                                        {{ $project->name }}
                                    </label>
                                @endforeach
                            </div>
                        </td>
                        {{-- Edit button --}}
                        <td class="editColumn">
                            <div class="editButton">
                                <button>Sauvegarder</button>
                                {{--<button>Modifier</button>
                                <button>Valider</button>--}}
                                <button type="button" wire:click="addStudentToEvent">
                                    @include('components.svg.add')
                                </button>
                            </div>
                        </td>
                        {{-- Delete --}}
                        <td class="deleteColumn">
                            <div class="deleteButton">
                                <button type="button">
                                    @include('components.svg.trash2')
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="emptyRow">
                    <td colspan="100%">
                        Aucun étudiant n'a encore été ajouté.
                    </td>
                </tr>
            @endif

            {{-- Row to add a button that allow to add a new student --}}
            <tr class="students__table__row3">
                <td colspan="100%">
                    <div class="addButton">
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

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- Add error validation --}}
    @error('students.*.name') <span class="error">{{ $message }}</span> @enderror
    @error('students.*.firstname') <span class="error">{{ $message }}</span> @enderror
    @error('students.*.email') <span class="error">{{ $message }}</span> @enderror
</div>
