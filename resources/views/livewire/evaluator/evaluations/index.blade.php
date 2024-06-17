<div>
    <main class="mainEvaluationStart">

        {{-- Naviagtion & breadcrumb --}}
        <x-evaluation-nav/>

        {{-- Choose the projet and evaluate it --}}
        <section class="evaluationStart">
            <h2 role="heading" aria-level="2" class="sr-only">Les projets à évaluer</h2>
            <div class="evaluationStart__header">
                <img src="{{ $contact->avatar }}" alt="{{ $contact->name }}">
                <p>{{ $contact->name }} {{ $contact->firstname }}</p>
            </div>
            <p class="evaluationStart__text">
                Sélectionnez un projet pour commencer l'évaluation.
            </p>
            <ul class="evaluationStart__list">

                <!-- TODO: boucle foreach des projets -->

                <li class="evaluationStart__list__item">
                    <a href="{{ route('events.evaluator-evaluation-edit', ['event' => $event, 'token' => $token]) }}"
                       class="evaluationStart__list__item__link button--gray">
                        Portfolio
                    </a>
                </li>
                <li class="evaluationStart__list__item">
                    <a href="" class="evaluationStart__list__item__link button--gray">Intégration wordpress</a>
                </li>
                <li class="evaluationStart__list__item">
                    <a href="" class="evaluationStart__list__item__link button--gray">Projet 3</a>
                </li>
            </ul>
        </section>
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->name ?? 'John Doe' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve du jour' }}</p>
    </footer>
</div>
