<x-app-layout>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Projets de l'administrateur</h1>
    @endsection

    <header class="header">
        <x-banner
            :title="'Liste de vos projets'"
            :message="'Voici ci-dessous la liste de tous vos projets.'"
        />
        <livewire:projects.add-project-dialog />
    </header>

    <main class="mainContacts max-width">
        <livewire:projects.show-projects />
    </main>
</x-app-layout>
