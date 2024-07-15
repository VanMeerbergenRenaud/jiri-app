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
            @forelse($this->studentFilter as $student)
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
                                <span>{{ $evaluation->status ?? 'Non vu' }}</span>
                            </li>
                            <li>
                                Temps d'activité
                                <time>{{ $evaluation->timer ?? '00:00' }}</time>
                            </li>
                            <li>
                                Projets
                                <span>{{ $projects->count() ?? 0 }}</span>
                            </li>
                            <li>
                                Moyenne
                                <span>{{ $evaluation->score ?? 'Commencer' }}</span>
                            </li>
                            <li>
                                Cotes
                                <span>{{ $evaluation->status ?? 'Non publiées' }}</span>
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
                <th @click="open = !open" wire:click="sortBy('name')">
                    Nom <x-svg.arrow-down />
                </th>
                <th @click="open = !open" wire:click="sortBy('visibility')">
                    Visibilité <x-svg.arrow-down />
                </th>
                <th @click="open = !open" wire:click="sortBy('activity_time')">
                    Temps d'activité <x-svg.arrow-down />
                </th>
                <th @click="open = !open" wire:click="sortBy('projects')">
                    Projets <x-svg.arrow-down />
                </th>
                <th @click="open = !open" wire:click="sortBy('evaluations')">
                    Moyenne <x-svg.arrow-down />
                </th>
                <th @click="open = !open" wire:click="sortBy('gradesStatus')">
                    Cotes <x-svg.arrow-down />
                </th>
                <th class="actions">Actions</th>
            </tr>
            </thead>

            <tbody wire:loading.class="opacity-50" class="table__students__tbody">
            @forelse ($this->studentFilter as $student)
                <tr>
                    @php
                        $evaluations = auth()->user()->evaluatorsEvaluations()
                            ->where('event_id', $this->event->id)
                            ->where('contact_id', $this->evaluator->id)
                            ->where('event_contact_id', $student->contact->id)
                            ->get();
                    @endphp
                    <td class="name capitalize">
                        <img src="{{ $student->contact->avatar ?? asset('img/placeholder.png') }}" alt="photo de profil du contact">
                        {{ $student->contact->name }}
                        {{ $student->contact->firstname }}
                    </td>
                    <td>
                        @php
                            $allEvaluated = true;

                            foreach($evaluations as $evaluation) {
                                if($evaluation->status === 'not evaluated') {
                                    $allEvaluated = false;
                                    break;
                                }
                            }
                        @endphp

                        {{ $allEvaluated ? 'Évalué' : 'Non évalué' }}
                    </td>
                    <td>
                        @php
                            $totalSeconds = collect($evaluations)->map(function ($evaluation) {
                                list($hours, $minutes, $seconds) = explode(':', $evaluation->timer ?? '00:00:00');
                                return ($hours * 3600) + ($minutes * 60) + $seconds;
                            })->sum();

                            $hours = floor($totalSeconds / 3600);
                            $minutes = floor(($totalSeconds % 3600) / 60);
                            $seconds = $totalSeconds % 60;

                            $dateTime = $hours . ':' . $minutes . ':' . $seconds;
                            $dateTime = date('H:i:s', strtotime($dateTime));

                            $formattedTotalTime = '';

                            if ($totalSeconds >= 3600) {
                                $formattedTotalTime = sprintf('%dh%02dmin', $hours, $minutes);
                            } elseif ($totalSeconds > 0) {
                                $formattedTotalTime = sprintf('%dmin', ($hours * 60) + $minutes);
                            } else {
                                $formattedTotalTime = '0';
                            }

                        @endphp

                        <time datetime="{{ $dateTime }}">
                            {{ $formattedTotalTime }}
                        </time>
                    </td>
                    <td>
                        {{ $projects->count() ?? 0 }}
                    </td>
                    <td>
                        @php
                            $sumScores = 0;
                            $countScores = 0;

                            foreach($evaluations as $evaluation) {
                                if (isset($evaluation->score)) {
                                    $sumScores += $evaluation->score;
                                    $countScores++;
                                }
                            }
                            $averageScore = $countScores > 0
                                ? ($sumScores / $countScores)
                                : 0;
                        @endphp

                        {{ number_format($averageScore, 2) }} / 20
                    </td>
                    <td>
                        @php
                            $allPublic = true;

                            foreach($evaluations as $evaluation) {
                                if($evaluation->public === 0) {
                                    $allPublic = false;
                                    break;
                                }
                            }
                        @endphp

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
            {{ $this->studentFilter->links() }}
        </div>
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->name ?? 'Nom inconnu' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve non mentionnée' }}</p>
    </footer>
</div>

