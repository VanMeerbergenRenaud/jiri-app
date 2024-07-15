<div class="jiriesComment">
    <div class="jiriesComment__head">
        <img src="{{ $contact->avatar ?? asset('img/placeholder.png') }}" alt="Photo du contact">
        <span>
            {{ $contact->name }} {{ $contact->firstname }}
        </span>
    </div>

    <ul class="jiriesComment__list">
        @if($contactType === 'evaluator')
            @foreach ($students as $student)
                <li x-data="{ open: false, isSelected: false }" class="jiriesComment__list__item">
                    <div class="jiriesComment__list__item__infos" :class="{ 'isSelected': isSelected }"
                         @click="open = !open; isSelected = !isSelected">
                        <div class="jiriesComment__list__item__infos__evaluator">
                            <img src="{{ $student->contact->avatar ?? asset('img/placeholder.png') }}"
                                 alt="Photo de l'évaluateur">
                            <span>
                                {{ $student->contact->name }} {{ $student->contact->firstname }}
                            </span>
                        </div>
                        <span>@include('components.svg.arrow-down')</span>
                    </div>

                    {{-- All the ratings & comments for all the projects of a student --}}
                    <ul x-show="open" x-transition.opacity class="jiriesComment__list__item__commentList">
                        @foreach ($projects as $project)
                            @php
                                $evaluationForStudent = $evaluationsFromEvaluator
                                    ->where('project_id', $project->project->id)
                                    ->where('contact_id', $student->contact->id);
                            @endphp
                            <li class="jiriesComment__list__item__commentList__item">
                                <div>
                                    <h3 class="font-semibold capitalize">
                                        {{ $project->project->name ?? 'Projet inconnu' }}
                                    </h3>
                                    <span>
                                        @if($evaluationForStudent->isEmpty())
                                            ? / 20
                                        @else
                                            @foreach($evaluationForStudent as $evaluation)
                                                {{ $evaluation->score ?? 'Non renseigné' }} / 20
                                            @endforeach
                                        @endif
                                    </span>
                                </div>
                                <p>
                                    @if($evaluationForStudent->isEmpty())
                                        Aucun commentaire n’a encore été enregistré jusqu’à présent pour
                                        ce projet.
                                    @else
                                        @foreach($evaluationForStudent as $evaluation)
                                            {{ $evaluation->comment ?? 'Aucun commentaire n’a encore été enregistré jusqu’à présent pour ce projet.' }}
                                        @endforeach
                                    @endif
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        @else
            <p class="empty">
                Aucune cote n’a encore été enregistrée jusqu’à présent.
            </p>
        @endif
    </ul>
</div>
