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
        <h1 role="heading" aria-level="1" class="evaluator__header__title">
            {{ __('Tableau de bord principal') }}
        </h1>

        <!-- Avatar of the evaluator -->
        <img src="{{ $evaluator->avatar ?? asset('img/placeholder.png') }}" alt="profil de {{ $evaluator->name }}" class="evaluator__header__img"
        >
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
        <ul class="mainEvaluatorDashboard__list">
            @foreach($events as $event)
                <li class="mainEvaluatorDashboard__list__item">
                    <a href="{{ route('events.evaluator-dashboard-event', [
                            'event' => $event->event,
                            'contact' => $evaluator,
                            'token' => $event->token
                        ]) }}"
                        class="mainEvaluatorDashboard__list__item__link"
                        title="Vers le dashboard de l'épreuve {{ $event->event->name }}"
                        wire:navigate
                    >
                        @php
                            $date = Carbon\Carbon::parse($event->event->starting_at);
                        @endphp
                        <span><strong>Nom de l'épreuve</strong>: {{ $event->event->name }}</span>
                        <span>
                            <strong>Date de commencement</strong>: <time datetime="{{ $date->format('Y-m-d') }}">
                                {{ $date->format('d/m/Y') }}
                            </time>
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->name ?? 'Nom inconnu' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuves de l'évaluateur</p>
    </footer>
</div>
