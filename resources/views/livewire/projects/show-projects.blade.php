<div>
    <label class="search w-full" for="search">
        @include('components.svg.search')
        <input type="text" name="search" id="search" wire:model.live.debounce="search" placeholder="Rechercher un projet...">
    </label>

    <table class="table__contact">
        <thead class="projects">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Url / Read.me</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>

        <tbody wire:loading.class="opacity-50" class="projects">
            @forelse ($this->projectFilter as $project)
                <livewire:projects.project-row
                    :key="$project->id"
                    :$project
                    @deleted="delete({{ $project->id }})"
                />
            @empty
                <tr>
                    <td colspan="100%" class="empty">
                        Aucun project trouvé.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-links">
        {{ $this->projectFilter->links() }}
    </div>

    <div>
        @if($deleted)
            <x-notifications
                icon="delete"
                title="Projet supprimé avec succès !"
                method="$set('deleted', false)"
            />
        @endif
    </div>
</div>
