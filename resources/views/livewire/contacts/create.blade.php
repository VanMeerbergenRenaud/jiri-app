<x-app-layout>
    <div>
        {{-- Création d'un formulaire pour ajouter un contact à la base de donnée --}}
        <form method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}"><br>
            {{-- Error if not correct --}}
            @error('name')
            <p>{{ $message }}</p>
            @enderror
            <label for="firstname">Firstname:</label><br>
            <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}"><br>
            {{-- Error if not correct --}}
            @error('firstname')
            <p>{{ $message }}</p>
            @enderror
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" value="{{ old('email') }}"><br>
            {{-- Error if not correct, and contact already existing --}}
            @error('email')
            <p>{{ $message }}</p>
            @enderror

            {{-- Image upload component --}}
            <livewire:image-upload />

            <button type="submit" class="block mt-18">Submit</button>
        </form>
    </div>
</x-app-layout>
