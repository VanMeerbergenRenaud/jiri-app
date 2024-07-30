<div class="jiriesComment">
    <h3 role="heading" aria-level="3" class="title">Commentaires des membres du jury</h3>
    <ul class="jiriesComment__list">
        @foreach ($evaluators as $evaluator)
            <li x-data="{ open: false, isSelected: false }" class="jiriesComment__list__item">
                <div class="jiriesComment__list__item__infos" :class="{ 'isSelected': isSelected }"
                     @click="open = !open; isSelected = !isSelected">
                    <div class="jiriesComment__list__item__infos__evaluator">
                        <img src="{{ $evaluator->contact->avatar ?? asset('img/placeholder.png') }}"
                             alt="Photo de l'évaluateur">
                        <span>
                            {{ $evaluator->contact->name ?? 'Évaluateur' }} {{ $evaluator->contact->firstname ?? 'inconnu' }}
                        </span>
                    </div>
                    <span>
                        @include('components.svg.arrow-down')
                    </span>
                </div>

                {{-- All the ratings & comments for all the projects of a student --}}
                <ul x-show="open" x-transition.opacity class="jiriesComment__list__item__commentList">
                    @foreach ($projects as $project)
                        @php
                            $evaluationsOfEvaluator = $evaluationsOfEvaluators
                                ->where('project_id', $project->project->id)
                                ->where('contact_id', $evaluator->contact->id)
                        @endphp
                        <li class="jiriesComment__list__item__commentList__item">
                            <div>
                                <p class="jiriesComment__list__item__commentList__item__title">
                                    {{ ucfirst($project->project->name) ?? 'Projet inconnu' }}
                                </p>
                                <span>
                                    @if($evaluationsOfEvaluator->isEmpty())
                                        ? / 20
                                    @else
                                        @foreach($evaluationsOfEvaluator as $evaluation)
                                            {{ $evaluation->score ?? 'Non renseigné' }} / 20
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            <p class="jiriesComment__list__item__commentList__item__text">
                                @if($evaluationsOfEvaluator->isEmpty())
                                    Aucun commentaire n’a encore été enregistré jusqu’à présent pour ce projet.
                                @else
                                    @foreach($evaluationsOfEvaluator as $evaluation)
                                        {{ $evaluation->comment ?? 'Aucun commentaire n’a encore été enregistré jusqu’à présent pour ce projet.' }}
                                    @endforeach
                                @endif
                            </p>
                        </li>
                    @endforeach

                    <li class="jiriesComment__list__item__commentList__item">
                        @php
                            $scoredProjects = $evaluationsOfEvaluators->where('contact_id', $evaluator->contact->id);

                            $totalScore = $scoredProjects->sum('score');

                            $globalCote = $scoredProjects->count() > 0
                                ? $totalScore / $scoredProjects->count()
                                : null;
                        @endphp
                        <div>
                            <p role="heading" aria-level="4" class="jiriesComment__list__item__commentList__item__title">
                                Commentaire global
                            </p>
                            <span>
                                {{ number_format($globalCote, 2) ?? '?' }} / 20
                            </span>
                        </div>
                        <p class="jiriesComment__list__item__commentList__item__text">
                            {{ $this->getGlobalCommentForStudent($evaluator->contact->id) ?? 'Aucun commentaire global enregistré.' }}
                        </p>
                    </li>
                </ul>
            </li>
        @endforeach
    </ul>
</div>
