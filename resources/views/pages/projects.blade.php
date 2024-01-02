<x-app-layout>
    <header class="header mb-10">
        <x-header
            :title="'Liste de vos projets'"
            :message="'Voici ci-dessous la liste de tous vos projets.'"
        />
        <livewire:projects.add-project-dialog />
    </header>

    <main class="mainContacts">
        <livewire:projects.show-projects />
    </main>
</x-app-layout>
