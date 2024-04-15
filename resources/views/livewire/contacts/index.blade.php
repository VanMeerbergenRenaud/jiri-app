<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Contacts de l'administrateur</h1>
    @endsection

    <header class="header">
        <x-banner
            :title="'Liste de vos contacts'"
            :message="'Voici ci-dessous la liste de tous vos contacts.'"
        />
        <livewire:contacts.add-contact-dialog />
    </header>

    <main class="mainContacts max-width p-main">
        <livewire:contacts.show-contacts />
    </main>
</div>
