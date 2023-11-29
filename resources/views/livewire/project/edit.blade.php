<div>
    <p>
        Edit the project : {{ $project->name }}
    </p>

    <form method="POST" action="{{ route('projects.update', $project->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $project->name }}" required>
            @error('name')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category">Category</label>
            <input type="text" id="category" name="category" value="{{ $project->tasks }}" required>
            @error('category')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            {{-- Can't edit the value --}}
            <input type="text" id="description" name="description" value="{{ $project->description }}">
            @error('description')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update the project</button>

        {{-- TODO : Avertissement avec une boite modale si le projet à déjà été nommé sous ce nom --}}
    </form>
</div>
