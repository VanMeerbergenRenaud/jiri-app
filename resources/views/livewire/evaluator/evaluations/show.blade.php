<div>
    <main class="mainEvaluationSummary">
        <div class="mainEvaluationSummary__header">

            {{-- Left Side --}}
            <div class="evaluation-nav">

                {{-- Go back link --}}
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
                            <x-svg.nav-arrow-right/>
                        </li>
                        <li class="breadcrumb__list__item">
                            <a href="#" class="breadcrumb__list__item__link">
                                Tableau de bord
                                {{--{{ route('events.evaluator-dashboard-event') }}"> pour le dashboard d'un event spécifique --}}
                            </a>
                            <x-svg.nav-arrow-right/>
                        </li>
                        <li>
                            <span aria-current="page" class="breadcrumb__list__item__link">Fiche résumé</span>
                        </li>
                    </ol>
                </nav>
            </div>

            {{-- Right Side --}}
            <div class="evaluation-infos">
                Status : terminé -> select
                Timer -> select
            </div>
        </div>

        {{-- Part 2 : Resume of the evaluations --}}
       <section>
           <h2>Résumé des évaluations</h2>
       </section>
    </main>
</div>
