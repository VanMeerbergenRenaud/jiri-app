<x-app-layout>
    <main class="mainContacts">
        <div class="contacts__intro mb-10">
            <livewire:header
                :title="'Bonjour ' . $user->name"
                :message="'Voici ci-dessous la liste de tous vos projets.'"
            />
            <livewire:projects.add-project-dialog />
        </div>

        <livewire:projects.show-projects />
    </main>
</x-app-layout>
