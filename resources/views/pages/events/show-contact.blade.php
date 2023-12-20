<x-app-layout>
    <main class="mainProfil">
        <div class="mainProfil__intro">
            <h2>Profil du contact
            </h2>
            <p>Découvrez toutes les informations de {{ $contact->name }}.</p>
        </div>

        <div class="mainProfil__nav">
            <a href="/" class="button--gray">
                @include('components.svg.arrow-left')
                Retour
            </a>
            <label for="students">
                <select id="students">
                    <option value="" selected disabled>Sélectionnez un autre étudiant !</option>
                    <option value="1">Etudiant 1</option>
                    <option value="2">Etudiant 2</option>
                </select>
            </label>
        </div>

        <livewire:contacts.show-contact-profil :$contact />
    </main>
</x-app-layout>
