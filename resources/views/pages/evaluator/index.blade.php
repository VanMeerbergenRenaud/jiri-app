<x-evaluator-layout>
    <main class="mainEvaluator">
        <div class="evaluators__intro">
            <livewire:header
                :title="'Bonjour cher ' . $evaluator->name ?? 'Évaluateur'"
                :message="'Choisissez un étudiant a évaluer..'"
            />
        </div>

        <livewire:evaluator.dashboard />
    </main>
</x-evaluator-layout>
