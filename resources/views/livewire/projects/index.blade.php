<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Listes des projets de {{ auth()->user()->name }}</h1>
    @endsection

    <header class="header">
        <x-banner
            :title="'Liste de vos projets'"
            :message="'Voici ci-dessous la liste de tous vos projets.'"
        />
        <livewire:projects.add-project-dialog />
    </header>

    <main class="mainContacts max-width p-main">
        <livewire:projects.show-projects />
    </main>
</div>
