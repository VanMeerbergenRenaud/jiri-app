<div>
    {{-- Création d'un formulaire pour ajouter un projet à la base de donnée --}}
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br>
        {{-- Error if not correct --}}
        @error('name')
        <p>{{ $message }}</p>
        @enderror
        <label for="tasks">Tasks:</label><br>
        <input type="text" id="tasks" name="tasks" value="{{ json_encode(["$project->tasks"]) }}"><br>
        {{-- Error if not correct --}}
        @error('task')
        <p>{{ $message }}</p>
        @enderror
        <label for="description">Description:</label><br>
        <textarea type="text" id="description" name="description" value="{{ old('description') }}" required></textarea><br>
        {{-- Error if not correct, and project already existing --}}
        @error('description')
        <p>{{ $message }}</p>
        @enderror
        <button type="submit">Submit</button>
    </form>
</div>
