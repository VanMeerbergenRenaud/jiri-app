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

            <div>
                <label for="profile_image">Profile image</label>
                <input type="file" id="profile_image" name="profile_image" value="{{ $contact->profile_image }}">
                @error('profile_image')
                <p>{{ $message }}</p>
                @enderror
            </div>

            {{-- Preview of the image --}}
            <div>
                <img src="{{ $contact->profile_image }}" alt="Profile image" class="w-20 h-20 object-cover">
                {{-- If no image --}}
                @if ($contact->profile_image == null)
                <p class="bold">No image</p>
                @endif
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</x-app-layout>
