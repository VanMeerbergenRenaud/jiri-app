<x-app-layout>
    <main class="mainProfil">

        <div class="mainProfil__intro">
            <h3>Profil d'un étudiant</h3>
            <p>Découvrez toutes les informations de {{ $contact->name }}.</p>
        </div>

        <div class="mainProfil__nav">
            <a href="/" class="button--gray">
                @include('components.svg.arrow-left')
                Retour
            </a>
            <label for="students">
                <select id="students">
                    <option value="" selected disabled>Sélectionnez un étudiant...</option>
                    <option value="1">Etudiant 1</option>
                    <option value="2">Etudiant 2</option>
                </select>
            </label>
        </div>

        <livewire:contacts.show-contact-profil />
    </main>
</x-app-layout>
