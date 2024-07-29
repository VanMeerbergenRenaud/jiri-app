<div class="event__status">
    <span class="event__status__title" for="timer">Durée&nbsp;:</span>

    {{-- Event timer --}}
    @if ($event->started_at !== null && $event->paused_at === null && $event->finished_at === null)
        <span class="event__status__timer" id="timer" wire:poll.1s="updateTimer">
            {{ $hours }}:{{ $minutes }}:{{ $seconds }}
        </span>
    @elseif ($event->paused_at !== null && $event->finished_at === null)
        <span class="event__status__timer-pause" id="timer">
            EN PAUSE
        </span>
    @elseif ($event->finished_at === null)
        <span class="event__status__timer" id="timer" wire:poll.1s="updateTimer">
            {{ $hours }}:{{ $minutes }}:{{ $seconds }}
        </span>
    @endif

    {{-- Event status --}}
    <span class="event__status__title">Status&nbsp;:</span>
    <span class="event__status__actions">
        @if ($event->started_at !== null && $event->paused_at === null && $event->finished_at === null)
            <span class="event__status__actions__started">En cours</span>
            <span class="event__status__actions__paused">
                <button class="button--white" type="button" wire:click="pauseEvent">
                    <x-svg.pause />
                </button>
            </span>
        @elseif ($event->paused_at !== null && $event->finished_at === null)
            <span class="event__status__actions__finished">En pause</span>
        @elseif ($event->finished_at !== null)
            <span class="event__status__actions__finished">Terminé</span>
        @else
            En attente
        @endif
    </span>

    @if($event->paused_at !== null && $event->finished_at === null)
        <x-dialog wire:model="eventOnPause">
            <x-dialog.panel>
                <div class="form__content">
                    <h2 class="title">Modification du status</h2>
                    <p>L'épreuve à été mise en pause. Voulez-vous la continuer ou plutôt la terminer définitevement&nbsp;?</p>
                </div>

                <x-dialog.footer>
                    <button type="button" wire:click="finishEvent" class="cancel">Terminer</button>
                    <button type="button" wire:click="continueEvent" class="save">Continuer</button>
                </x-dialog.footer>
            </x-dialog.panel>
        </x-dialog>
    @endif
</div>
