<div>
    <label class="search w-full mt-2" for="search">
        @include('components.svg.search')
        <input type="text" name="search" id="search" wire:model.live.debounce="search" placeholder="Rechercher une épreuve...">
    </label>

    <div wire:loading.class.delay="opacity-50" class="mt-8">
        @if($pastEvents->isNotEmpty())
            <ul class="list list1">
                Liste des épreuves passées
                @foreach($pastEvents as $event)
                    <livewire:events.event-row
                        :key="$event->id"
                        :$event
                        @deleted="delete({{ $event->id }})"
                    />
                @endforeach
            </ul>
        @endif
        @if($currentEvents->isNotEmpty())
            <ul class="list list2">
                Liste des épreuves en cours
                @foreach($currentEvents as $event)
                    <livewire:events.event-row
                        :key="$event->id"
                        :$event
                        @deleted="delete({{ $event->id }})"
                    />
                @endforeach
            </ul>
        @endif
        @if($futureEvents->isNotEmpty())
            <ul class="list list3">
                Liste des épreuves à venir
                @foreach($futureEvents as $event)
                    <livewire:events.event-row
                        :key="$event->id"
                        :$event
                        @deleted="delete({{ $event->id }})"
                    />
                @endforeach
            </ul>
        @endif
        @if($events->count() === 0)
            Liste des épreuves
            <div class="flex-center empty">
                <p>Aucune épreuve n’a encore été créée jusqu’à présent.</p>
                <livewire:events.add-event-dialog @added="$refresh" />
            </div>
        @endif
    </div>

    {{--<div class="pagination-links">
        {{ $events->links() }}
    </div>--}}

    <div>
        @if($saved)
            <x-notifications
                icon="delete"
                title="Épreuve supprimée avec succès !"
                message="Vous avez dit au revoir à cette épreuve..."
                method="$set('saved', false)"
            />
        @endif
    </div>
</div>
