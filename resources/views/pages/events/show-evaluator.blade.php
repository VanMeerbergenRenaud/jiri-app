<x-evaluator-layout>
    <main class="mainEvaluator">
        <div class="evaluators__intro">
            <livewire:header
                :title="'Bonjour cher ' . $evaluator->contact->name . ' 👋🏻.'  ??  'évaluateur 👋🏻.'"
                :message="'Choisissez un étudiant a évaluer.'"
            />
        </div>

        <livewire:evaluator.dashboard />
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->contact->name }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>{{ 'Épreuve - ' . $event->name ?? 'Épreuve' }}</p>
    </footer>
</x-evaluator-layout>
