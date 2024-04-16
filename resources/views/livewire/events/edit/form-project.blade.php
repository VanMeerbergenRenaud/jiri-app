<div>
    {{-- Form to edit a new project --}}
    <template x-if="createmode">
        <form wire:submit.prevent="save" class="contact__new__form">
            <p>Ajouter un projet</p>
            <div class="contact__new__form__container">
                {{-- Nom du projet --}}
                <div class="contact__new__form__container__label">
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
                    {{--<label for="newprojecttasks">Listes des tâches</label>
                    <select id="newprojecttasks" wire:model="newprojecttasks">
                        <option value="0" selected>Sélectionner une ou plusieurs tâche(s)</option>
                        @foreach($tasks as $task)
                            <option value="{{ $task->name }}">{{ ucfirst($task->name) }}</option>
                        @endforeach
                    </select>
                    @error('newprojecttasks')
                    <div class="error-message">{{ $message }}</div>
                    @enderror--}}
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
