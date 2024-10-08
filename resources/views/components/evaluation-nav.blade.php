<div {{ $attributes->class(['evaluation-nav']) }}>

    {{-- Go back link --}}
    <div class="inline-block">
        <a href="{{ url()->previous() }}" class="button--gray" title="Retour à la page précédente" wire:navigate>
            @include('components.svg.arrow-left')
            Retour
        </a>
    </div>

    <!-- Fil d'Ariane -->
    <nav aria-label="breadcrumb" class="breadcrumb">
        <h2 role="heading" aria-level="2" class="sr-only">Menu de navigation pour un évaluateur</h2>
        <ol class="breadcrumb__list">
            <li class="breadcrumb__list__item">
                <a href="{{ route('events.evaluator-dashboard', [
                                'contact' => $evaluator,
                    ]) }}"
                   class="breadcrumb__list__item__link"
                   title="Vers le tableau de bord des épreuves de l'évaluateur"
                >
                    Mes épreuves
                </a>
                <x-svg.nav-arrow-right/>
            </li>
            <li class="breadcrumb__list__item">
                <a href="{{ route('events.evaluator-dashboard-event', [
                            'contact' => $evaluator,
                            'event' => $event,
                            'token' => $token
                    ]) }}"
                   class="breadcrumb__list__item__link"
                   title="Vers le tableau de bord d'évaluation de l'épreuve"
                >
                    Tableau de bord
                </a>
                <x-svg.nav-arrow-right/>
            </li>
            <li>
                <span aria-current="page" class="breadcrumb__list__item__link">Fiche résumé</span>
            </li>
        </ol>
    </nav>
</div>
