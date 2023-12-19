<x-app-layout>
    <p>Hello {{ $contact->name }}</p>
    <div>
        <p>
            Name: {{ $contact->name }}
        </p>
        <p>
            Firstname: {{ $contact->firstname }}
        </p>
        <p>
            Email: {{ $contact->email }}
        </p>
        <p>
            Profile image: {{ $contact->profile_image }}
        </p>
    </div>
</x-app-layout>
