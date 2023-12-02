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
                    <select id="newprojecttasks" wire:model="newprojecttasks">
                        <option value="0" disabled selected>Sélectionner une tâche</option>
                        <option value="1">Une tâche</option>
                        {{--@foreach($tasks as $id => $task)
                            <option wire:key="{{$id}}" value="{{ $id }}">{{ ucfirst($task) }}</option>
                        @endforeach--}}
                    </select>
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
