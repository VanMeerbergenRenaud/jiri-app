<x-evaluator-layout>
    <div class="header">
        <x-header
            :title="'Bonjour ' . $evaluator->contact->name . ' 👋🏻.'  ??  'évaluateur 👋🏻.'"
            :message="'Choisissez un étudiant a évaluer.'"
        />
    </div>

    <main class="mainEvaluator">
        <livewire:evaluator.dashboard />
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->contact->name }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>{{ 'Épreuve - ' . $event->name ?? 'Épreuve du jour' }}</p>
    </footer>
</x-evaluator-layout>
