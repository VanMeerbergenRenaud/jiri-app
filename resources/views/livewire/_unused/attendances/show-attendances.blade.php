<div>
    <h2 class="mb-2">Étudiants</h2>

    <label class="search w-full" for="searchStudent">
        @include('components.svg.search')
        <input type="text" name="searchStudent" id="searchStudent" wire:model.live.debounce="searchStudent" placeholder="Rechercher un contact...">
    </label>

    <table class="table__contact mt-4">
        <thead>
            <tr>
                <th>Rôle</th>
                <th>Token</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>

        <tbody wire:loading.class.delay="opacity-50">
            @forelse ($this->attendanceFilterStudent as $attendance)
                <livewire:events.attendances.attendance-row
                    :key="$attendance->id"
                    :$attendance
                    @deleted="delete({{ $attendance->id }})"
                />
            @empty
                <tr>
                    <td colspan="100%" class="empty">
                        <x-svg.contact/>
                        <span>Aucune attendance trouvée.</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-links">
        {{ $this->attendanceFilterStudent->links() }}
    </div>

    <h2 class="mb-2">Évaluateurs</h2>

    <label class="search w-full" for="searchEvaluator">
        @include('components.svg.search')
        <input type="text" name="searchEvaluator" id="searchEvaluator" wire:model.live.debounce="searchEvaluator" placeholder="Rechercher un contact...">
    </label>

    <table class="table__contact mt-4">
        <thead>
            <tr>
                <th>Rôle</th>
                <th>Token</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>

        <tbody wire:loading.class.delay="opacity-50">
        @forelse ($this->attendanceFilterEvaluator as $attendance)
            <livewire:events.attendances.attendance-row
                :key="$attendance->id"
                :$attendance
                @deleted="delete({{ $attendance->id }})"
            />
        @empty
            <tr>
                <td colspan="100%" class="empty">
                    <x-svg.contact/>
                    <span>Aucune attendance trouvée.</span>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination-links">
        {{ $this->attendanceFilterEvaluator->links() }}
    </div>

    <div>
        @if($saved)
            <x-notifications
                icon="delete"
                title="Attendance supprimée avec succès !"
                message="Vous avez dit au revoir à cette attendance."
                method="$set('saved', false)"
            />
        @endif
    </div>
</div>
