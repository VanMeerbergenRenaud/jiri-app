<div>
    <header class="evaluator__header">
        <!-- Logo -->
        <a  class="logo__link" title="Vers la page de toutes mes épreuves"
            href="{{ route('events.evaluator-dashboard', [
                'contact' => $evaluator
            ]) }}"
        >
            <x-logo />
            <span>Jiri.app</span>
        </a>

        <!-- Title of the page -->
        <h1 class="evaluator__header__title">{{ $evaluator->name ?? 'Tableau de bord principal' }}</h1>

        <!-- Avatar of the evaluator -->
        {{-- TODO : add a route for the evaluator profil so he can change his profile --}}
        <img src="{{ $evaluator->avatar ?? asset('img/placeholder.png') }}" alt="profil de {{ $evaluator->name }}" class="evaluator__header__img">
    </header>

    <!-- Header -->
    <div class="header">
        <x-banner
            :title="'Bonjour ' . ($evaluator->name ?? 'cher évaluateur') . ' 👋🏻.'"
            :message="'Choisissez un épreuve que vous devez évaluer.'"
        />
    </div>

    <!-- Main content -->
    <main class="mainEvaluatorDashboard">
        <ul>
            @foreach($events as $event)
                <li>
                    <a href="{{ route('events.evaluator-dashboard-event', [
                            'event' => $event->event,
                            'contact' => $evaluator,
                            'token' => $event->token
                        ]) }}" wire:navigate
                    >
                        {{ $event->id }} - {{ $event->event->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </main>
</div>
