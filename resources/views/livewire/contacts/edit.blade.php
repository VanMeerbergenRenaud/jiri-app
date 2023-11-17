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
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $contact->email }}" required>
        </div>

        <button type="submit">Update Profile</button>
    </form>
</div>
