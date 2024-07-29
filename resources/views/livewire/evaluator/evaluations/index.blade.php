<div>
    <livewire:evaluator.header :evaluator="$evaluator" :event="$event" />

    <main class="mainEvaluationStart">

        {{-- Naviagtion & breadcrumb --}}
        <x-evaluation-nav :event="$event" :evaluator="$evaluator" :token="$token"/>

        {{-- Choose the projet and evaluate it --}}
        <section class="evaluationStart">
            <h2 role="heading" aria-level="2" class="sr-only">Les projets à évaluer</h2>
            <div class="evaluationStart__header">
                <img src="{{ $student->avatar ?? asset('img/placeholder.png') }}" alt="{{ $student->name }}">
                <p>{{ $student->name }} {{ $student->firstname }}</p>
            </div>
            <p class="evaluationStart__text">
                Sélectionnez un projet pour commencer l'évaluation.
            </p>
            <ul class="evaluationStart__list">
                @foreach($projects as $project)

                    <li class="evaluationStart__list__item">
                        <a href="{{ route('events.evaluator-evaluation-edit' , [
                            'event' => $event,
                            'contact' => $evaluator,
                            'token' => $token,
                            'student' => $student,
                            'project' => $project
                        ]) }}" wire:navigate
                           class="evaluationStart__list__item__link button--gray">
                            {{ $project->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->name ?? 'Nom inconnu' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve non mentionnée' }}</p>
    </footer>
</div>
