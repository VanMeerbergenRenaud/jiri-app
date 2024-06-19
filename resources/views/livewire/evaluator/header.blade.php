<div>
    <header class="evaluator__header">
        <!-- Logo -->
        {{-- TODO : change the route to 'events.evaluator-dashboard' --}}
        <a href="{{ route('events.evaluator-dashboard', ['contact' => $contact]) }}" class="logo__link" title="Vers la page de toutes mes épreuves">
            <x-logo />
            <span>Jiri.app</span>
        </a>

        <!-- Name of the event -->
        <h1 class="evaluator__header__title">{{ $title ?? 'Dashboard évaluateur' }}</h1>

        <!-- Avatar of the evaluator -->
        {{-- TODO : add a route so the evaluator can change his profile --}}
        <img src="{{ $avatar ?? asset('img/placeholder.png') }}" alt="photo de profil du contact" class="evaluator__header__img">
    </header>
</div>
