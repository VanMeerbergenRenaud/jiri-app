<div>
    <h2 class="title">Tableau de résumé des cotes</h2>
    <table class="second-table">
        <thead>
        {{-- First line for evaluators --}}
        <tr class="row-1">
            <th scope="row" class="category sticky">Membres du jury</th>
            @foreach($evaluators as $evaluator)
                <th scope="col" colspan="{{ $projects->count() ?? 1 }}" wire:key="e{{ $evaluator->id }}"
                    class="jiris sticky-small">
                    <a href="{{ route('events.contact-profil', ['event' => $event, 'contact' => $evaluator->contact]) }}">
                        <img src="{{ $evaluator->contact->avatar ?? asset('img/placeholder.png') }}"
                             alt="photo d'un membre du jury">
                        {{ $evaluator->contact->name ?? 'Évaluateur' }}
                    </a>
                </th>
            @endforeach
            <th rowspan="{{ $evaluators->count() }}" class="moy sticky">Moyenne</th>
            <th rowspan="{{ $evaluators->count() }}" class="cg sticky">Cote globale</th>
            <th rowspan="{{ $evaluators->count() }}" class="cd sticky">Cote délibée</th>
        </tr>
        {{-- Second line for projets --}}
        <tr class="row-2">
            <th scope="row" class="category sticky">Étudiants&nbsp;|&nbsp;Projets</th>
            @foreach($evaluators as $evaluator)
                @foreach($projects as $project)
                    <th class="project sticky-small">
                        {{ $project->name ?? 'Projet' }}
                    </th>
        @endforeach
        @endforeach
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr class="row-3" wire:key="s{{ $student->id }}">
                {{-- Students --}}
                <th scope="row" class="students sticky">
                    <a href="{{ route('events.contact-profil', ['event' => $event, 'contact' => $student->contact]) }}">
                        <img src="{{ $student->contact->avatar ?? asset('img/placeholder.png') }}"
                             alt="photo d'un étudiant">
                        {{ $student->contact->name ?? 'Étudiant' }}
                    </a>
                </th>
                {{-- Score sur /20 --}}
                @foreach($evaluators as $evaluator)
                    @foreach($projects as $project)
                        <td class="results">
                            <span>
                                {{ $this->getScore(
                                       $student->contact->id,
                                       $evaluator->contact->id,
                                       $project->id
                                   ) ?? '?' }}</span>/20
                        </td>
                    @endforeach
                @endforeach
                {{-- Average --}}
                <td class="moy">{{ $this->getAverageScore($student->contact->id) ?? '?' }} / 20</td>
                {{-- Score ponderation 1 | Globale --}}
                <td class="cg">{{ $this->calculateWeightedScore('ponderation1', $student->contact->id) ?? '?' }} / 20</td>
                {{-- Score ponderation 2 | Délibé --}}
                <td class="cd">{{ $this->calculateWeightedScore('ponderation2', $student->contact->id) ?? '?' }} / 20</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="second-table--footer">
        <button class="button--blue" type="button">
            Mode plein écran
        </button>
    </div>
</div>
