<div>
    <table class="second-table">
        <thead>
        {{-- First line for jiris members --}}
        <tr class="row-1">
            <th scope="row" class="category sticky">Membres du jury</th>
            @foreach($evaluators as $evaluator)
                <th scope="col" colspan="{{ /*$projects->count() ??*/ 3 }}" wire:key="e{{ $evaluator->id }}" class="jiris sticky-small">
                    <img src="{{ $evaluator->contact->avatar ?? asset('img/dominique.png') }}" alt="photo d'un membre du jury">
                    {{ $evaluator->contact->name ?? 'Évaluateur' }}
                </th>
            @endforeach
            <th rowspan="{{ $evaluators->count() }}" class="moy sticky">Moyenne</th>
            <th rowspan="{{ $evaluators->count() }}" class="cg sticky">Cote globale</th>
            <th rowspan="{{ $evaluators->count() }}" class="cga sticky">Cote globale avantageuse</th>
            <th rowspan="{{ $evaluators->count() }}" class="cd sticky">Cote de délibée</th>
        </tr>
        {{-- Second line for projets --}}
        <tr class="row-2">
            <th scope="row" class="category sticky">Étudiants&nbsp;|&nbsp;Projets</th>
            @for ($i = 1; $i <= 4; $i++)
                @for ($j = 1; $j <= 3; $j++)
                    <th class="project sticky-small">Projet {{ $j }}</th>
                @endfor
            @endfor
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr class="row-3" wire:key="s{{ $student->id }}">
                {{-- Students --}}
                <th scope="row" id="etudiant-{{ $i }}" class="students sticky">
                    <img src="{{ $student->contact->avatar ?? asset('img/dominique.png') }}" alt="photo d'un étudiant">
                    {{ $student->contact->name ?? 'Étudiant' }}
                </th>
                {{-- Cotes ->  /20 --}}
                @for ($j = 1; $j <= 4; $j++)
                    @for ($k = 1; $k <= 3; $k++)
                        <td headers="etudiant-{{ $i }} jury-{{ $j }} projet-{{ $k }}" class="results">
                            9/20
                        </td>
                    @endfor
                @endfor
                {{-- Moyenne --}}
                <td class="moy">9 / 20</td>
                {{-- Cote globale --}}
                <td class="cg">11 / 20</td>
                {{-- Cote globale avantageuse --}}
                <td class="cga">8 / 20</td>
                {{-- Cote délibée --}}
                <td class="cd">10 / 20</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
