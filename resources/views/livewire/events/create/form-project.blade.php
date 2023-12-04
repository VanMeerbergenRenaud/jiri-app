<div>
    {{-- Form to create a new project --}}
    <template x-if="createmode">
        <form wire:submit.prevent="save" class="contact__new__form">
            <p>Ajouter un projet</p>
            <div class="contact__new__form__container">
                {{-- Nom du projet --}}
                <div class="project-name">
                    <label for="newprojectname">Nom du projet</label>
                    <input
                        type="text"
                        id="newprojectname"
                        wire:model="newprojectname"
                        placeholder="Ex : Portfolio"
                    >
                    @error('newprojectname')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Tasks --}}
                <div class="project-tasks">
                    <label for="newprojecttasks">Listes des tâches</label>
                    <ul id="newprojecttasks" wire:model="newprojecttasks">
                        @if(!empty($tasks))
                            @foreach($tasks as $id => $task)
                                <li wire:key="{{$id}}">
                                    <label for="newprojecttasks-{{ $id }}">
                                        <input type="checkbox" name="{{ $task }}" id="newprojecttasks-{{ $id }}" wire:model="newprojecttasks-{{ $id }}">
                                        {{ ucfirst($task) }}
                                    </label>
                                </li>
                            @endforeach
                        @else
                            <p>Aucune tâche n'est associée à ce projet.</p>
                        @endif
                    </ul>
                    @error('newprojecttasks')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Ajouter une tâche --}}
                <div class="project-task">
                    <label for="newprojecttask">Ajouter une tâche</label>
                    <input
                        type="text"
                        id="newprojecttask"
                        wire:model="newprojecttask"
                        placeholder="Ex : CV"
                    >
                    <button type="button">Ajouter</button>
                    @error('newprojecttask')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Button to cancel the new contact --}}
                <button type="button" class="cancel" @click="createmode = false">
                    Annuler
                </button>
                {{-- Button to save the new contact --}}
                <button type="submit" class="save">
                    Enregistrer
                </button>
                {{-- Validation message --}}
            </div>
        </form>
    </template>
</div>
