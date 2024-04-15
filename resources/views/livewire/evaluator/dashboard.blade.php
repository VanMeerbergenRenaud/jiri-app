<div>
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
                            <span>{{ 'Vu' ?? 'Non vu' }}</span>
                        </li>
                        <li>
                            Temps d'activité
                            <time>{{ '3h 10min' ?? '00:00' }}</time>
                        </li>
                        <li>
                            Projets
                            <span>{{ $projects->count() ?? 0 }}</span>
                        </li>
                        <li>
                            Évaluations
                            <span>{{ 'Modifier' ?? 'Commencer' }}</span>
                        </li>
                        <li>
                            Cotes
                            <span>{{ 'Publiées' ?? 'Non publiées' }}</span>
                        </li>
                        <li>
                            <a href="#" class="students__list__content__link">Évaluer</a>
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
                    Évaluations <x-svg.arrow-down />
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
                    <td class="name capitalize">
                        <img src="{{ $student->contact->avatar ?? asset('img/placeholder.png') }}" alt="photo de profil du contact">
                        {{ $student->contact->name }}
                        {{ $student->contact->firstname }}
                    </td>
                    <td>
                        {{ $student->visibility ?? 'Non vu' }}
                    </td>
                    <td>
                        {{ $student->activity_time ?? '00:00' }}
                    </td>
                    <td>
                        {{ $projects->count() ?? 0 }}
                    </td>
                    <td>
                        {{ $student->evaluations ?? 'Commencer' }}
                    </td>
                    <td>
                        {{ $student->gradesStatus ?? 'Non publiées' }}
                    </td>
                    <td class="actions">
                        <a href="#" class="students__list__content__link">Évaluer</a>
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
</div>
