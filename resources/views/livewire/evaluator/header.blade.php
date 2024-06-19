<div>
    <header class="evaluator__header">
        <!-- Logo -->
        <a  class="logo__link" title="Vers la page de toutes mes épreuves"
            href="{{ route('events.evaluator-dashboard', [
                'contact' => $contact
            ]) }}"
        >
            <x-logo />
            <span>Jiri.app</span>
        </a>

        <!-- Name of the event -->
        <h1 class="evaluator__header__title">{{ $event->name ?? 'Dashboard évaluateur' }}</h1>

        <!-- Avatar of the evaluator -->
        {{-- TODO : add a route for the evaluator profil so he can change his profile --}}
        <img src="{{ $contact->avatar ?? asset('img/placeholder.png') }}" alt="profil de {{ $contact->name }}" class="evaluator__header__img">
    </header>
</div>
