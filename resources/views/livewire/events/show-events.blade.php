<div>
    <label class="search w-full" for="search">
        @include('components.svg.search')
        <input type="text" name="search" id="search" wire:model.live.debounce="search" placeholder="Rechercher une épreuve...">
    </label>

    <div wire:loading.class.delay="opacity-50" class="events__list">
        @unless($this->pastEvents || $this->currentEvents || $this->futureEvents)
            Liste des épreuves
            <div class="empty">
                <p>Aucune épreuve n’a encore été créée jusqu’à présent.</p>
                <livewire:events.add-event-dialog @added="$refresh" />
            </div>
        @else
            @if($this->pastEvents->isNotEmpty())
                <ul class="list list1">
                    Liste des épreuves passées
                    @foreach($this->pastEvents as $event)
                        <livewire:events.event-row
                            :key="$event->id"
                            :$event
                            @deleted="delete({{ $event->id }})"
                        />
                    @endforeach
                </ul>
                <div class="pagination-links">
                    {{ $this->pastEvents->links() }}
                </div>
            @endif
            @if($this->currentEvents->isNotEmpty())
                <ul class="list list2">
                    Liste des épreuves en cours
                    @foreach($this->currentEvents as $event)
                        <livewire:events.event-row
                            :key="$event->id"
                            :$event
                            @deleted="delete({{ $event->id }})"
                        />
                    @endforeach
                </ul>
                <div class="pagination-links">
                    {{ $this->currentEvents->links() }}
                </div>
            @endif
            @if($this->futureEvents->isNotEmpty())
                <ul class="list list3">
                    Liste des épreuves à venir
                    @foreach($this->futureEvents as $event)
                        <livewire:events.event-row
                            :key="$event->id"
                            :$event
                            @deleted="delete({{ $event->id }})"
                        />
                    @endforeach
                </ul>
                <div class="pagination-links">
                    {{ $this->futureEvents->links() }}
                </div>
            @endif
            @if($this->pastEvents->isEmpty() && $this->currentEvents->isEmpty() && $this->futureEvents->isEmpty())
                <div class="empty-event">
                    <p>Aucune épreuve ne correspond à votre recherche.</p>
                </div>
            @endif
        @endunless
    </div>

    <div>
        @if($saved)
            <x-notifications
                icon="delete"
                title="Épreuve supprimée avec succès !"
                method="$set('saved', false)"
            />
        @endif
    </div>
</div>
