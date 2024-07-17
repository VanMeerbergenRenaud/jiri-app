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

        
            {{--@if($events->isEmpty() ||
                $availableEvent->isEmpty() &&
                $currentEvent->isEmpty() &&
                $pausedEvent->isEmpty() &&
                $finishedEvent->isEmpty()
                )
                <p>
                    Vous n'avez aucune épreuve à commencer, en cours, en pause ou terminée.
                </p>
            @else

                <!-- Start of the event -->
                <div class="dashboard__events__availableEvent">
                    <h2>Épreuves que vous pouvez démarrer dès maintenant</h2>

                    <ul>
                        @forelse($availableEvent as $available)
                            <li wire:key="{{ $available->id }}">
                                <x-dialog>
                                    <x-dialog.open>
                                        <button type="button" class="button--blue">{{ $available->name }}</button>
                                    </x-dialog.open>

                                    <x-dialog.panel>
                                        <form class="form" wire:submit.prevent="startEvent({{ $available->id }})">
                                            <div class="form__content">
                                                <h2 class="title">Commencer l'épreuve</h2>
                                                <span class="bold">{{ $available->name }}</span>
                                                <ul>
                                                    <li>
                                                        <span>Date de début :</span>
                                                        {{ $available->starting_at }}
                                                    </li>
                                                    <li>
                                                        <span>Durée :</span>
                                                        {{ $available->duration }}
                                                    </li>
                                                    <li>
                                                        Status: éligible
                                                    </li>
                                                </ul>
                                            </div>

                                            <x-dialog.footer>
                                                <x-dialog.close>
                                                    <button type="button" class="cancel">Annuler</button>
                                                </x-dialog.close>

                                                <button type="submit" class="save"
                                                        wire:submit="startEvent({{ $available->id }})">Commencer
                                                </button>
                                            </x-dialog.footer>
                                        </form>
                                    </x-dialog.panel>
                                </x-dialog>
                            </li>
                        @empty
                            <li>
                                Aucune épreuve à démarrer
                            </li>
                        @endforelse
                    </ul>
                </div>
            @endif--}}
    </div>

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
