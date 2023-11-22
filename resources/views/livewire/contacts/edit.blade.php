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
            <input type="email" id="email" name="email" value="{{ $contact->email }}" required>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update Profile</button>
    </form>
</div>
