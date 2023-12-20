<div>
    <div>
        <label class="search w-full" for="search">
            @include('components.svg.search')
            <input type="text" name="search" id="search" wire:model.live.debounce="search" placeholder="Rechercher un projet...">
        </label>
    </div>

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
        @forelse ($projects as $project)
            <livewire:projects.project-row
                :key="$project->id"
                :$project
                @deleted="delete({{ $project->id }})"
            />
        @empty
            <tr>
                <td colspan="100%" class="py-2" style="min-width: 300px">
                    Aucun project trouvé.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div>
        @if(session()->has('success'))
            <x-notifications
                icon="delete"
                title="Projet supprimé avec succès !"
                message="Vous avez supprimé un projet qui facilitera sûrement la vie de vos étudiants."
                method="$set('saved', false)"
            />
        @endif
    </div>
</div>
