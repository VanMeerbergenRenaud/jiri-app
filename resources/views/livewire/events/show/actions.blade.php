<div class="event__status">
    <span class="event__status__title" for="timer">Durée&nbsp;:</span>

    @if ($event->started_at !== null)
        <span id="timer" wire:poll.1s="updateTimer">
            {{ $hours }}:{{ $minutes }}:{{ $seconds }}
        </span>
    @else
        <span id="timer">00:00:00</span>
    @endif

    <label for="status">Status&nbsp;:</label>
    <select id="status" wire:change="updateStatus($event.target.value)">
        <option disabled>Choisir un status</option>
        <option value="started" selected>En cours</option>
        <option value="paused">En pause</option>
        <option value="finished">Terminer</option>
    </select>
</div>
