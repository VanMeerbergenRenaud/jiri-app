<div>
    <livewire:evaluator.header :evaluator="$evaluator" :event="$event" />

    <main class="mainEvaluationSummary">

        {{-- Header --}}
        <div class="mainEvaluationSummary__header">

            {{-- Naviagtion & breadcrumb --}}
            <x-evaluation-nav :event="$event" :evaluator="$evaluator" :token="$token"/>

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
                    Temps passé avec l'étudiant&nbsp;:&nbsp;{{ $this->formatTimer($timer) ?? '00h00min' }}
                </span>
            </div>
        </div>

        {{-- Resume of the evaluations --}}
        <section class="evaluationSummary">
           <h2 role="heading" aria-level="2" class="sr-only">Résumé des évaluations</h2>
            <div class="evaluationSummary__header">
                <img src="{{ $student->avatar ?? asset('img/placeholder.png') }}" alt="{{ $student->name }}">
                <p>{{ $student->name }} {{ $student->firstname }}</p>
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
                                <a href="{{ $project->url_readme ?? '#' }}" target="_blank" title="Lien vers le projet descriptif">
                                    {{ $project->url_readme ?? 'non mentionné' }}
                                </a>
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
                                <a href="{{ $project->repo ?? '#' }}" target="_blank" title="Lien vers le repo Github">
                                    {{ $project->repo ?? 'non mentionné' }}
                                </a>
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
                                @foreach($tasks as $task)
                                    <span>{{ $task->name ?? 'non mentionné' }}</span> |
                                @endforeach
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
                                {{ $info->where('project_id', $project->id)->first()->status ?? 'non vu' }}
                            </td>
                        @endforeach
                        <td>
                            @if($info->where('status', 'evaluated')->count() === $projects->count())
                                <span class="status--evaluated">Tout vu</span>
                            @else
                                <span class="status--not-evaluated">Tout non vu</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Cote</th>
                        @foreach($projects as $project)
                            <td>
                                <span>{{ $info->where('project_id', $project->id)->first()->score ?? '?' }}</span> / 20
                            </td>
                        @endforeach
                        <td>
                            @php
                                $scoredProjects = $info->filter(function ($evaluation) {
                                    return !is_null($evaluation->score);
                                });

                                $totalScore = $scoredProjects->sum('score');

                                $globalCote = $scoredProjects->count() > 0
                                    ? $totalScore / $scoredProjects->count()
                                    : null;
                            @endphp
                            <span>{{ number_format($globalCote, 2) ?? '?' }}</span> / 20
                        </td>
                    </tr>
                    <tr>
                        <th>Commentaire</th>
                        @foreach($projects as $project)
                            <td class="comment">
                                <p>{{ $info->where('project_id', $project->id)->first()->comment ?? 'Aucun commentaire ajouté.' }}</p>
                                <a href="{{ route('events.evaluator-evaluation-edit' , [
                                        'event' => $event,
                                        'contact' => $evaluator,
                                        'token' => $token,
                                        'student' => $student,
                                        'project' => $project,
                                    ]) }}">Modifier</a>
                            </td>
                        @endforeach
                        <td class="comment">
                            <p>{{ $globalComment ?? 'Aucun commentaire global ajouté.' }}</p>
                            <form wire:submit.prevent="updateGlobalComment">
                                @csrf

                                <x-dialog wire:model="show">
                                    <x-dialog.open>
                                        <button type="button" class="button--gray">
                                            Modifier
                                        </button>
                                    </x-dialog.open>

                                    <x-dialog.panel>
                                        <div class="form__content">
                                            <h2 class="title">Commentaire global</h2>
                                            <p class="text">
                                                Veuillez ajouter votre commentaire global pour <span class="bold">{{ $student->name }}</span>.
                                            </p>
                                            <x-form.textarea
                                                label="Commentaire global"
                                                name="globalComment"
                                                model="globalComment"
                                                placeholder="Ajouter un commentaire global"
                                                srOnly="true"
                                                maxlength="1000"
                                                class="globalComment__textarea"
                                            />
                                        </div>

                                        <x-dialog.footer>
                                            <x-dialog.close>
                                                <button type="button" class="cancel">Annuler</button>
                                            </x-dialog.close>

                                            <button wire:click="updateGlobalComment" class="save">
                                                Enregistrer
                                            </button>
                                        </x-dialog.footer>
                                    </x-dialog.panel>
                                </x-dialog>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
       </section>
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->name ?? 'Nom inconnu' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve non mentionnée' }}</p>
    </footer>
</div>
