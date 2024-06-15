<div>
    <main class="mainEvaluationStart">
        <div class="evaluation-nav">
            <div class="inline-block">
                <a href="{{ url()->previous() }}" class="button--gray" title="Retour à la page précédente" wire:navigate>
                    @include('components.svg.arrow-left')
                    Retour
                </a>
            </div>

            <!-- Fil d'Ariane -->
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__list__item">
                        <a href="#" class="breadcrumb__list__item__link">
                            Mes épreuves
                            {{--{{ route('events.evalautor-dashboard') }}"> pour les events d'un évaluateur --}}
                        </a>
                        <x-svg.nav-arrow-right />
                    </li>
                    <li class="breadcrumb__list__item">
                        <a href="#" class="breadcrumb__list__item__link">
                            Tableau de bord
                            {{--{{ route('events.evaluator-dashboard-event') }}"> pour le dashboard d'un event spécifique --}}
                        </a>
                        <x-svg.nav-arrow-right />
                    </li>
                    <li>
                        <span aria-current="page" class="breadcrumb__list__item__link">Évaluation</span>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Part with 2 steps : Choose the projet and evaluate it --}}
        <div class="evaluation">
            <div class="evaluation__header">
                <img src="{{ $contact->avatar }}" alt="{{ $contact->name }}">
                <p>{{ $contact->name }} {{ $contact->firstname }}</p>
            </div>
            <p class="evaluation__text">
                Sélectionnez un projet pour commencer l'évaluation.
            </p>
            <ul class="evaluation__list">
                {{-- boucle foreach des projets--}}
                <li class="evaluation__list__item">
                    <a href="{{ route('events.evaluator-evaluation-edit', ['event' => $event, 'token' => $token]) }}"
                       class="evaluation__list__item__link button--gray">
                        Portfolio
                    </a>
                </li>
                <li class="evaluation__list__item">
                    <a href="" class="evaluation__list__item__link button--gray">Intégration wordpress</a>
                </li>
                <li class="evaluation__list__item">
                    <a href="" class="evaluation__list__item__link button--gray">Projet 3</a>
                </li>
            </ul>
        </div>
    </main>
</div>
