<div>
    <main class="mainEvaluationSummary">

        {{-- Header --}}
        <div class="mainEvaluationSummary__header">

            {{-- Naviagtion & breadcrumb --}}
            <x-evaluation-nav :event="$event" :contact="$contact" :token="$token"/>

            {{-- Evaluation infos (status,timer) --}}
            <div class="evaluation-infos">
                <label for="eventStatus" class="sr-only">Status de l'évaluation</label>
                <select name="eventStatus" id="eventStatus" class="evaluation-infos__status">
                    <option disabled selected value="">Choisir un status</option>
                    <option value="start">Non terminé et non publié</option>
                    <option value="now">En cours d'acheminement</option>
                    <option value="end">Tout terminer et publier</option>
                </select>

                <span class="evaluation-infos__timer">
                    <x-svg.clock/>
                    Temps passé avec l'étudiant&nbsp;:&nbsp;{{ $evaluation->time ?? '00h00' }}
                </span>
            </div>
        </div>

        {{-- Resume of the evaluations --}}
        <section class="evaluationSummary">
           <h2 role="heading" aria-level="2" class="sr-only">Résumé des évaluations</h2>
            <div class="evaluationSummary__header">
                <img src="{{ $contact->avatar ?? asset('img/placeholder.png') }}" alt="{{ $contact->name }}">
                <p>{{ $contact->name }} {{ $contact->firstname }}</p>
            </div>

            <table class="evaluationSummary__table">
                <thead>
                    <tr>
                        <th>Résumé des projets</th>
                        @foreach($projects as $project)
                            <th>{{ $project->name ?? 'aucun' }}</th>
                        @endforeach
                        <th>Globalement</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            Url du projet
                        </th>
                        @foreach($projects as $project)
                            <td>
                                <a href="{{ $project->link ?? '#' }}">{{ $project->url ?? 'non mentionné' }}</a>
                            </td>
                        @endforeach
                        <td>
                            /
                        </td>
                    </tr>
                    <tr>
                        <th>Repo Github</th>
                        @foreach($projects as $project)
                            <td>
                                <a href="{{ $project->repo ?? '#' }}">{{ $project->repo ?? 'non mentionné' }}</a>
                            </td>
                        @endforeach
                        <td>
                            /
                        </td>
                    </tr>
                    <tr>
                        <th>Présentation</th>
                        @foreach($projects as $project)
                            <td>
                                <p>{{ $project->tasks ?? 'non mentionné' }}</p>
                            </td>
                        @endforeach
                        <td>
                            /
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        @foreach($projects as $project)
                            <td>
                                {{ $project->status ?? 'non vu' }}
                            </td>
                        @endforeach
                        <td>
                            {{ $project->status ?? 'non vu' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Cote</th>
                        @foreach($projects as $project)
                            <td>
                                <span>{{ $project->score ?? '?' }}</span>/20
                            </td>
                        @endforeach
                        <td>
                            <span>{{ $project->moyScore ?? '?' }}</span>/20
                        </td>
                    </tr>
                    <tr>
                        <th>Commentaire</th>
                        @foreach($projects as $project)
                            <td class="comment">
                                <p>{{ $project->comment ?? 'Aucun commentaire ajouté.' }}</p>
                                <button type="submit" class="button--gray">Modifier</button>
                            </td>
                        @endforeach
                        <td class="comment">
                            <p>{{ $project->globalComment ?? 'Aucun commentaire global ajouté.' }}</p>
                            <button type="submit" class="button--gray">Modifier</button>
                        </td>
                    </tr>
                </tbody>
            </table>
       </section>
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->name ?? 'John Doe' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve du jour' }}</p>
    </footer>
</div>
