<div>
    @if($events->isEmpty())
        <div class="empty-event">
            <p>Aucune épreuve n'a encore été créée jusqu'à présent.</p>
        </div>
    @else
        <label class="search w-full" for="search">
            @include('components.svg.search')
            <input type="text" name="search" id="search" wire:model.live.debounce="search" placeholder="Rechercher une épreuve...">
        </label>

        <div wire:loading.class.delay="opacity-50" class="events__list">

            @if($availableEvents->isNotEmpty())
                <ul class="list list-available">
                    Épreuves disponibles
                    @foreach($availableEvents as $event)
                        <livewire:events.event-row
                            :key="$event->id"
                            :$event
                            @deleted="delete({{ $event->id }})"
                        />
                    @endforeach
                </ul>
                <div class="pagination-links">
                    {{ $availableEvents->links() }}
                </div>
            @endif

            @if($currentEvents->isNotEmpty())
                <ul class="list list-current">
                    Épreuves en cours
                    @foreach($currentEvents as $event)
                        <livewire:events.event-row
                            :key="$event->id"
                            :$event
                            @deleted="delete({{ $event->id }})"
                        />
                    @endforeach
                </ul>
                <div class="pagination-links">
                    {{ $currentEvents->links() }}
                </div>
            @endif

            @if($pausedEvents->isNotEmpty())
                <ul class="list list-pause">
                    Épreuves en pause
                    @foreach($pausedEvents as $event)
                        <livewire:events.event-row
                            :key="$event->id"
                            :$event
                            @deleted="delete({{ $event->id }})"
                        />
                    @endforeach
                </ul>
                <div class="pagination-links">
                    {{ $pausedEvents->links() }}
                </div>
            @endif

            @if($finishedEvents->isNotEmpty())
                <ul class="list list-finish">
                    Épreuves terminées
                    @foreach($finishedEvents as $event)
                        <livewire:events.event-row
                            :key="$event->id"
                            :$event
                            @deleted="delete({{ $event->id }})"
                        />
                    @endforeach
                </ul>
                <div class="pagination-links">
                    {{ $finishedEvents->links() }}
                </div>
            @endif

            @if($comingSoonEvents->isNotEmpty())
                <ul class="list list-comingSoon">
                    Épreuves à venir
                    @foreach($comingSoonEvents as $event)
                        <livewire:events.event-row
                            :key="$event->id"
                            :$event
                            @deleted="delete({{ $event->id }})"
                        />
                    @endforeach
                </ul>
                <div class="pagination-links">
                    {{ $comingSoonEvents->links() }}
                </div>
            @endif

            @if($events->isEmpty())
                <div class="empty-event-start">
                    <p>Aucune épreuve n’a encore été créée jusqu’à présent.</p>
                    <livewire:events.add-event-dialog @added="$refresh"/>
                </div>
            @endif

            @if($availableEvents->isEmpty() && $currentEvents->isEmpty() && $pausedEvents->isEmpty() && $finishedEvents->isEmpty() && $comingSoonEvents->isEmpty() && $events->isNotEmpty())
                <div class="empty-event">
                    <p>Aucune épreuve ne correspond à votre recherche.</p>
                </div>
            @endif
        </div>
    @endif

    <div>
        @if($deleted)
            <x-notifications
                icon="delete"
                title="Épreuve supprimée avec succès !"
                method="$set('deleted', false)"
            />
        @endif
    </div>
</div>
