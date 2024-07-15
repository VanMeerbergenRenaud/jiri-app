<div class="jiriesComment">
    <h3 class="title">Commentaires des membres du jury</h3>
    <ul class="jiriesComment__list">
        @foreach ($evaluators as $evaluator)
            {{-- for each $comments from evaluators --}}
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
                                ->where('event_contact_id', $evaluator->contact->id)
                        @endphp
                        <li class="jiriesComment__list__item__commentList__item">
                            <div>
                                <h4 class="font-semibold capitalize">
                                    {{ $project->project->name ?? 'Projet inconnu' }}
                                </h4>
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
                            <p>
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
                </ul>
            </li>
        @endforeach
    </ul>
</div>
