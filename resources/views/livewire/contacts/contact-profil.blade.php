<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Profil d'un contact</h1>
    @endsection

    <main class="mainProfil max-width">
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
            <x-form.select
                label="Nom d'un autre contact du même événement"
                name="name"
                placeholder="Sélectionner un autre profil -"
                :options="$event->contacts"
                srOnly="true"
                wire:change="redirectUser($event.target.value)"
            />
        </div>

        <livewire:contacts.show-contact-profil :$event :$contact />
    </main>
</div>
