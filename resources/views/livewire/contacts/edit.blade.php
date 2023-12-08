<x-app-layout>
    <div>
        <p>
            Edit the profil of {{ $contact->name }}
        </p>

        <form method="POST" action="{{ route('contacts.update', $contact->id) }}">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $contact->name }}" required>
                @error('name')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="firstname">Name</label>
                <input type="text" id="firstname" name="firstname" value="{{ $contact->firstname }}" required>
                @error('firstname')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email">Email</label>
                {{-- Can't edit the value --}}
                <input type="text" id="email" name="email" value="{{ $contact->email }}" readonly>
                @error('email')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</x-app-layout>
