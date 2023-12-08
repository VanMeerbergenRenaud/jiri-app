<div>
    <h2>
        Modifier le projet : {{ $project ? $project->name : 'Projet non trouvé' }}
    </h2>

    <form method="POST" action="{{ route('projects.update', $project->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $project->name }}">
            @error('name')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="{{ $project->description }}">
            @error('description')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <button class="button--classic">Update the project</button>
    </form>

    <h3>Formulaire d'ajout d'une tâche</h3>
    <form wire:submit.prevent="addTask()">
        @csrf
        <label for="newtask">Nome de la tâche :</label><br>
        <input type="text" id="newtask" wire:model="newtask" value="{{ old('newtask') }}">
        @error('newtask')
        <p>{{ $message }}</p>
        @enderror
        <button type="submit">Ajouter une tâche</button>
    </form>

    <h4>Liste des tâches associées à ce projet :</h4>
    <ul>
        @foreach($project->tasks as $task)
            <li>
                {{ ucfirst($task->name) }}
                <button wire:click="deleteTask({{ $task->id }})"
                >Supprimer</button>
            </li>
        @endforeach
    </ul>
    {{-- If nothing --}}
    @if(count($project->tasks) === 0)
        <p>Aucune tâche n'est associée à ce projet.</p>
    @endif
</div>
