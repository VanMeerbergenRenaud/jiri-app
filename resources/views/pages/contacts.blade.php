<x-app-layout>
    <main class="mainContacts">
        <div class="contacts__intro">
            <livewire:header
                :title="'Bonjour ' . $user->name"
                :message="'Voici ci-dessous la liste de tous vos contacts.'"
            />
            <livewire:contacts.add-contact-dialog />
        </div>

        <livewire:contacts.show-contacts />
    </main>
</x-app-layout>
