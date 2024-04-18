<div>
    <label class="search w-full" for="search">
        @include('components.svg.search')
        <input type="text" name="search" id="search" wire:model.live="search" placeholder="Rechercher un projet...">
    </label>

    <table class="table__contact">
        <thead class="projects">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Tâches</th>
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
                    <td colspan="100%" class="py-2 min-w-80">
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
        @if($saved)
            <x-notifications
                icon="delete"
                title="Projet supprimé avec succès !"
                method="$set('saved', false)"
            />
        @endif
    </div>
</div>
