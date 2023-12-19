<x-app-layout>
    <main class="mainContacts">
        <div class="contacts__intro">
            <livewire:header
                :title="'Bonjour ' . $user->name"
                :message="'Voici ci-dessous la liste de tous vos projets.'"
            />
            <livewire:projects.add-project-dialog @added="$refresh" />
        </div>

        <livewire:projects.show-projects />
    </main>
</x-app-layout>
