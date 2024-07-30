<div>
    <header class="evaluator__header">
        <!-- Logo -->
        <a  class="logo__link" title="Vers la page de toutes mes épreuves"
            href="{{ route('events.evaluator-dashboard', ['contact' => $evaluator->id]) }}"
        >
            <x-logo />
            <span>Jiri.app</span>
        </a>

        <!-- Title of the page -->
        <h1 role="heading" aria-level="1" class="evaluator__header__title">{{ 'Évènement ' . $event->name ?? 'Tableau de bord' }}</h1>

        <!-- Avatar of the evaluator -->
        {{-- TODO : add a route for the evaluator profil so he can change his profile --}}
        <img src="{{ $evaluator->avatar ?? asset('img/placeholder.png') }}" alt="profil de {{ $evaluator->name }}" class="evaluator__header__img">
    </header>
</div>
