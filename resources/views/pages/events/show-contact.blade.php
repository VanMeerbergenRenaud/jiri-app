<x-app-layout>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Profil d'un contact</h1>
    @endsection

    <main class="mainProfil">
        <div class="mainProfil__intro">
            <h2>Profil du contact
            </h2>
            <p>
                Découvrez toutes les informations de
                <span class="font-semibold">{{ $contact->name }}</span>
                pour l'épreuve <span class="font-semibold">{{ $event->name }}</span>.
            </p>
        </div>

        <div class="mainProfil__nav">
            <a href="{{ url()->previous() }}" class="button--gray">
                @include('components.svg.arrow-left')
                Retour
            </a>
            <label for="students">
                <select id="students">
                    <option value="" selected disabled>Sélectionnez un autre profil !</option>
                    <option value="1">Etudiant 1</option>
                    <option value="2">Etudiant 2</option>
                </select>
            </label>
        </div>

        <livewire:contacts.show-contact-profil :$contact />
    </main>
</x-app-layout>
