{{-- Contact view --}}
<x-app-layout>
    <main class="mainContacts">
        <div class="contacts__intro">
            <livewire:welcome-message
                    :title="'Bonjour ' . $user->name"
                    :message="'Découvrez la liste de tous vos contacts.'"
            />
            <a href="{{ route('events.create') }}" class="ml-8 button--classic">Créer un nouveau contact</a>
        </div>
        {{-- Liste des contacts --}}
        <div class="contacts__list">

        </div>
    </main>
</x-app-layout>
