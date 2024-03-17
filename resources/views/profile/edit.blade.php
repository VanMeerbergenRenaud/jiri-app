<x-app-layout>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Édition du profil de l'administrateur</h1>
    @endsection

    <main class="profile-admin">
        @include('profile.partials.update-profile-information-form')
        <x-divider />
        @include('profile.partials.update-password-form')
        <x-divider />
        @include('profile.partials.delete-user-form')
    </main>
</x-app-layout>
