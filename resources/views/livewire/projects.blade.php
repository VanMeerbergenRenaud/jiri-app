{{-- Projects view --}}
<x-app-layout>
    <main class="mainProjects">
        <div class="projects__intro">
            <livewire:welcome-message
                    :title="'Bonjour ' . $user->name"
                    :message="'Découvrez la liste de tous vos projets.'"
            />
            <a href="{{ route('events.create') }}" class="ml-8 button--classic">Créer un nouveau projet</a>
        </div>
        {{-- Liste des projets --}}
        <div class="projects__list">

        </div>
    </main>
</x-app-layout>
