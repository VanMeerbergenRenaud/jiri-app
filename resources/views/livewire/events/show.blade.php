<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Évènement {{  $event->name }}</h1>
    @endsection

    <header class="header">
        <x-banner
            :title="'Épreuve en cours'"
            :message="'Votre épreuve ' . $event->name . '  vient de commencer.'"
        />
    </header>

    <main class="mainEventShow max-width p-main">
        {{-- Event status action buttons --}}
        <div class="event__status" x-data="{
            activeButton: null,
            changeStatus: function() {
                if (this.activeButton === 'start') {
                    $wire.startEvent();
                } else if (this.activeButton === 'pause') {
                    $wire.pauseEvent();
                } else if (this.activeButton === 'end') {
                    $wire.endEvent();
                }
            }
        }">
            <label for="status">Status&nbsp;:</label>
            <select id="status"
                    x-model="activeButton"
                    x-on:change="changeStatus()"
            >
                <option value="start">Start</option>
                <option value="pause">Pause</option>
                <option value="end">End</option>
            </select>
        </div>

        {{-- First Table --}}
        <div class="event__show">
            <livewire:events.show.first-table />
        </div>

        {{-- Second Table --}}
        <div class="event__show__results">
            <livewire:events.show.second-table />
        </div>
    </main>
</div>
