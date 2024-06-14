<div>
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
                    Épreuves
                </a>
                <x-svg.nav-arrow-right />
            </li>
            <li class="breadcrumb__list__item">
                <a href="#" class="breadcrumb__list__item__link">
                    Tableau de bord
                </a>
                <x-svg.nav-arrow-right />
            </li>
            <li>
                <span aria-current="page" class="breadcrumb__list__item__link">Évaluation</span>
            </li>
        </ol>
        {{--
            {{ route('evaluator-events-dashboard') }}"> pour les épreuves
            {{ route('events.evaluator-dashboard') }}"> pour le dashboard
        --}}
    </nav>

    {{-- Part with 2 steps : Choose the projet and evaluate it --}}
    <div class="evaluation">
        <div class="evaluation__header">
            <img src="" alt="">
            <span>Renaud Van Meerbergen</span>
        </div>
        <p class="evaluation__text">
            Sélectionnez un projet pour commencer.
        </p>
        <ul class="evaluation__list">
            {{-- boucle foreach des projets--}}
            <li class="evaluation__list__item">
                <a href="" class="evaluation__list__item__link button--gray">Projet 1</a>
            </li>
            <li class="evaluation__list__item">
                <a href="" class="evaluation__list__item__link button--gray">Projet 2</a>
            </li>
            <li class="evaluation__list__item">
                <a href="" class="evaluation__list__item__link button--gray">Projet 3</a>
            </li>
        </ul>
    </div>
</div>
