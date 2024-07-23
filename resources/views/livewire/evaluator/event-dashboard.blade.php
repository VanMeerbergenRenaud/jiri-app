<div>
    <livewire:evaluator.header :evaluator="$evaluator" :event="$event" />

    <div class="header">
        <x-banner
            :title="'Bonjour ' . $evaluator->name . ' 👋🏻.'  ??  'cher évaluateur 👋🏻.'"
            :message="'Choisissez un étudiant a évaluer.'"
        />
    </div>

    <main class="mainEvaluator p-main">

        <label class="search" for="search">
            @include('components.svg.search')
            <input type="text" name="search" id="search" wire:model.live.debounce="search" placeholder="Rechercher un étudiant...">
        </label>

        {{-- Mobile --}}
        <ul class="students__list">
            @forelse($students as $student)
                @php
                    $studentEvaluations = $evaluations->get($student->contact->id, collect());

                    // Calculer la visibilité
                    $allEvaluated = $studentEvaluations->every(fn($evaluation) => $evaluation->status === 'evaluated') && $studentEvaluations->isNotEmpty() ? 'Évalué' : 'Non évalué';

                    // Calculer le temps d'activité total
                    $totalSeconds = $studentEvaluations->sum(function ($evaluation) {
                        list($hours, $minutes, $seconds) = explode(':', $evaluation->timer ?? '00:00:00');
                        return ($hours * 3600) + ($minutes * 60) + $seconds;
                    });

                    $hours = floor($totalSeconds / 3600);
                    $minutes = floor(($totalSeconds % 3600) / 60);

                    $formattedTotalTime = $totalSeconds >= 3600
                        ? sprintf('%dh%02dmin', $hours, $minutes)
                        : ($totalSeconds > 0 ? sprintf('%dmin', ($hours * 60) + $minutes) : '0');

                    // Calculer le nombre de projets évalués sur le total
                    $projectsEvaluated = $studentEvaluations->filter(fn($evaluation) => $evaluation->project_id !== null);

                    // Calculer la moyenne des scores
                    $sumScores = $studentEvaluations->sum('score');
                    $countScores = $studentEvaluations->count();

                    $averageScore = $countScores > 0 ? ($sumScores / $countScores) : 0;

                    // Vérifier si toutes les évaluations sont publiées
                    $allPublic = $studentEvaluations->every(fn($evaluation) => $evaluation->public === 1);
                @endphp
                <li x-data="{ open: false, isSelected: false }">
                    <div class="students__list__item" :class="{ 'isSelected': isSelected }" @click="open = !open; isSelected = !isSelected">
                        <div class="students__list__item__infos">
                            <img src="{{ $student->contact->avatar ?? asset('img/placeholder.png') }}" alt="">
                            <span>
                            {{ $student->contact->name }} {{ $student->contact->firstname }}
                        </span>
                        </div>
                        <span><x-svg.arrow-down /></span>
                    </div>

                    <div x-show="open" x-transition.opacity class="students__list__content">
                        <ul>
                            <li>
                                Visibilité

                                <span>{{ $allEvaluated }}</span>
                            </li>
                            <li>
                                Temps d'activité

                                <time datetime="{{ sprintf('%02d:%02d', $hours, $minutes) }}">
                                    {{ $formattedTotalTime ?? '00:00' }}
                                </time>
                            </li>
                            <li>
                                Projets
                                <span>{{ $projectsEvaluated->count() ?? '0' }} / {{ $projects->count() ?? '0' }}</span>
                            </li>
                            <li>
                                Moyenne

                                <span>{{ number_format($averageScore, 2) ?? '0' }} / 20</span>
                            </li>
                            <li>
                                Cotes

                                <span>{{ $allPublic ? 'Publié' : 'Non publié' }}</span>
                            </li>
                            <li>
                                <a href="{{ route('events.evaluator-evaluation-start' , [
                                        'event' => $event,
                                        'contact' => $evaluator,
                                        'token' => $token,
                                        'student' => $student->contact
                                    ]) }}"
                                   class="students__list__content__link"
                                   wire:navigate
                                >
                                    Évaluer
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @empty
                <li class="empty__list">
                    Aucun étudiant trouvé.
                </li>
            @endforelse
        </ul>

        {{-- Desktop --}}
        <table class="table__students">
            <thead class="table__students__thead">
            <tr x-data="{ open: false }">
                <th @click="open = !open" wire:click="sortByDirection">
                    Nom <x-svg.arrow-down />
                </th>
                <th>Visibilité</th>
                <th>Temps d'activité</th>
                <th>Projets</th>
                <th>Moyenne</th>
                <th>Cotes</th>
                <th class="actions">Actions</th>
            </tr>
            </thead>

            <tbody wire:loading.class="opacity-50" class="table__students__tbody">
            @forelse ($students as $student)
                @php
                    $studentEvaluations = $evaluations->get($student->contact->id, collect());

                    // Calculer la visibilité
                    $allEvaluated = $studentEvaluations->every(fn($evaluation) => $evaluation->status === 'evaluated') && $studentEvaluations->isNotEmpty() ? 'Évalué' : 'Non évalué';

                    // Calculer le temps d'activité total
                    $totalSeconds = $studentEvaluations->sum(function ($evaluation) {
                        list($hours, $minutes, $seconds) = explode(':', $evaluation->timer ?? '00:00:00');
                        return ($hours * 3600) + ($minutes * 60) + $seconds;
                    });

                    $hours = floor($totalSeconds / 3600);
                    $minutes = floor(($totalSeconds % 3600) / 60);

                    $formattedTotalTime = $totalSeconds >= 3600
                        ? sprintf('%dh%02dmin', $hours, $minutes)
                        : ($totalSeconds > 0 ? sprintf('%dmin', ($hours * 60) + $minutes) : '0');

                    // Calculer le nombre de projets évalués sur le total
                    $projectsEvaluated = $studentEvaluations->filter(fn($evaluation) => $evaluation->project_id !== null);

                    // Calculer la moyenne des scores
                    $sumScores = $studentEvaluations->sum('score');
                    $countScores = $studentEvaluations->count();

                    $averageScore = $countScores > 0 ? ($sumScores / $countScores) : 0;

                    // Vérifier si toutes les évaluations sont publiées
                    $allPublic = $studentEvaluations->every(fn($evaluation) => $evaluation->public === 1);
                @endphp

                <tr>
                    <td class="name capitalize">
                        <img src="{{ $student->contact->avatar ?? asset('img/placeholder.png') }}" alt="photo de profil du contact">
                        {{ $student->contact->name }}
                        {{ $student->contact->firstname }}
                    </td>
                    <td>
                        {{ $allEvaluated }}
                    </td>
                    <td>
                        <time datetime="{{ sprintf('%02d:%02d', $hours, $minutes) }}">
                            {{ $formattedTotalTime ?? '00:00' }}
                        </time>
                    </td>
                    <td>
                        {{ $projectsEvaluated->count() ?? '0' }} / {{  $projects->count() ?? '0' }}
                    </td>
                    <td>
                        {{ number_format($averageScore, 2) ?? '0' }} / 20
                    </td>
                    <td>
                        {{ $allPublic ? 'Publié' : 'Non publié' }}
                    </td>
                    <td class="actions">
                        <a href="{{ route('events.evaluator-evaluation-start' , [
                            'event' => $event,
                            'contact' => $evaluator,
                            'token' => $token,
                            'student' => $student->contact
                        ]) }}"
                           class="students__list__content__link"
                           wire:navigate
                        >
                            Évaluer
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="empty__list">
                        Aucun étudiant trouvé.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="pagination-links">
            {{ $students->links() }}
        </div>
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->name ?? 'Nom inconnu' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve non mentionnée' }}</p>
    </footer>
</div>

