<x-app-layout>
    <header class="header">
        <x-header
            :title="'Liste de vos contacts'"
            :message="'Voici ci-dessous la liste de tous vos contacts.'"
        />
        <livewire:contacts.add-contact-dialog />
    </header>

    <main class="mainContacts">
        <livewire:contacts.show-contacts />
    </main>
</x-app-layout>
