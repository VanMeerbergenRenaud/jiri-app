<div>
    <div class="actions__contact">
        <label class="search" for="search">
            @include('components.svg.search')
            <input type="text" name="search" id="search" wire:model.live.debounce="search" placeholder="Rechercher un contact...">
        </label>

        <livewire:import-contacts />
    </div>

    <table class="table__contact">
        <thead>
            <tr x-data="{ open: false }">
                <th @click="open = !open" wire:click="sortBy('name')">
                    Nom <x-svg.arrow-down />
                </th>
                <th @click="open = !open" wire:click="sortBy('firstname')">
                    Prénom <x-svg.arrow-down />
                </th>
                <th @click="open = !open" wire:click="sortBy('email')">
                    Adresse mail <x-svg.arrow-down />
                </th>
                <th class="actions">Actions</th>
            </tr>
        </thead>

        <tbody wire:loading.class.delay="opacity-50">
            @forelse ($this->contactFilter as $contact)
                <livewire:contacts.contact-row
                    :key="$contact->id"
                    :$contact
                    @deleted="delete({{ $contact->id }})"
                />
            @empty
                <tr>
                    <td colspan="100%" class="empty">
                        <x-svg.contact/>
                        <span>Aucun contact trouvé.</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-links">
        {{ $this->contactFilter->links() }}
    </div>

    <div>
        @if($deleted)
            <x-notifications
                icon="delete"
                title="Contact supprimé avec succès !"
                method="$set('deleted', false)"
            />
        @endif
    </div>
</div>
