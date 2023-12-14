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

    <form wire:submit.prevent="save" x-data="{showModal: false}">
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
                <th scope="col" class="editColumn">Modifier</th>
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
                                    @if($editStudentId && $student->id == $editStudentId)
                                        <input type="text" name="name" id="name" placeholder="Nom"
                                               wire:model.defer="name">
                                        @error('name') <span
                                            class="error-message w-full underline text-center mb-2">{{ $message }}</span> @enderror
                                    @else
                                        <input type="text" name="name" id="name" placeholder="Nom"
                                               value="{{ $student->name ?? '' }}" disabled>
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <label for="firstname">
                                    @if($editStudentId && $student->id == $editStudentId)
                                        <input type="text" name="firstname" id="firstname" placeholder="Prénom"
                                               wire:model.defer="firstname">
                                        @error('firstname') <span
                                            class="error-message w-full underline text-center mb-2">{{ $message }}</span> @enderror
                                    @else
                                        <input type="text" name="firstname" id="firstname" placeholder="Prénom"
                                               value="{{ $student->firstname ?? '' }}" disabled>
                                    @endif
                                </label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <label for="email">
                                    @if($editStudentId && $student->id == $editStudentId)
                                        <input type="text" name="email" id="email" placeholder="Email"
                                               wire:model.defer="email">
                                        @error('email') <span
                                            class="error-message w-full underline text-center mb-2">{{ $message }}</span> @enderror
                                    @else
                                        <input type="text" name="email" id="email" placeholder="Email"
                                               value="{{ $student->email ?? '' }}" disabled>
                                    @endif
                                </label>
                            </div>
                        </td>
                        {{-- Photo --}}
                        <td>
                            <div>
                                <label for="photo" x-data="{ files: null }" class="file">
                                    <input type="file" name="photo" id="photo"
                                           x-on:change="files = Object.values($event.target.files)">
                                    @include('components.svg.upload-file')
                                    <span
                                        x-text="files ? files.map(file => file.name).join(', ') : 'JPEG, JPG, PNG only'"></span>
                                </label>
                            </div>
                        </td>
                        {{-- Projects --}}
                        <td class="td__projects">
                            <div class="projects">
                                @foreach($projects as $project)
                                    <label for="project{{$index}}-{{ $project->id }}">
                                        @if($editStudentId && $student->id == $editStudentId)
                                            <input type="checkbox" name="project{{ $project->name }}" id="project{{$index}}-{{ $project->id }}" checked>
                                            {{ $project->name }}
                                        @else
                                            <input type="checkbox" name="project{{ $project->name }}" id="project{{$index}}-{{ $project->id }}" checked disabled>
                                            {{ $project->name }}
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        </td>
                        {{-- Edit button --}}
                        <td class="editColumn">
                            <div class="editButton">
                                @if($editStudentId && $student->id == $editStudentId)
                                    <button type="button" wire:click.prevent="saveStudent({{$student->id ?? ''}})"
                                            class="ml-4">
                                        Sauvegarder
                                    </button>
                                @else
                                    <button type="button" wire:click.prevent="editStudent({{$student->id ?? ''}})"
                                            class="ml-4">
                                        Editer
                                    </button>
                                @endif
                            </div>
                        </td>
                        {{-- Delete --}}
                        <td class="deleteColumn">
                            <div class="deleteButton">
                                <button type="button" wire:click.prevent="removeStudent({{$student->id ?? ''}})">
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
            </tbody>
        </table>

        <template x-if="showModal">
            <div class="modal">
                <div class="modal__dialog">
                    <form class="editEditionModal" wire:submit="createStudent">
                        @csrf
                        <h2>Ajouter un étudiant</h2>
                        <div class="editEditionModal__fields">
                            <div>
                                <label for="name">Nom</label>
                                <input type="text" name="name" id="name" placeholder="Nom" wire:model.defer="name">
                                @error('name') <span class="error-message my-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="firstname">Prénom</label>
                                <input type="text" name="firstname" id="firstname" placeholder="Prénom" wire:model.defer="firstname">
                                @error('firstname') <span class="error-message my-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" placeholder="Email" wire:model.defer="email">
                                @error('email') <span class="error-message my-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo" wire:model.defer="photo">
                                @error('photo') <span class="error-message my-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="projects">
                                <h3 class="projects__title">Projets</h3>
                                @foreach($projects as $project)
                                    <label for="project{{$index}}-{{ $project->id }}">
                                        <input type="checkbox" name="project{{ $project->name }} "
                                               id="project{{$index}}-{{ $project->id }}"
                                               checked
                                        >
                                        {{ $project->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="editEditionModal__buttons">
                            <button type="button" class="cancel" @click="showModal = false">Annuler</button>
                            <button class="confirm">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        <div class="flex justify-end">
            <button type="button" class="button--classic mt-4 inline-flex items-center gap-2" @click="showModal = true">
                Ajouter un étudiant
                @include('components.svg.add')
            </button>
        </div>
    </form>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
