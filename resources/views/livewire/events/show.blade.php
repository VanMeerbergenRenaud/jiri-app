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
        {{-- TODO: Event status action buttons --}}
        <div class="event__status">
            Status : {{ $event->status() }}
            <button wire:click="pauseEvent">Pause</button>
            <button wire:click="endEvent">Terminer</button>
        </div>

        {{-- First Table --}}
        <div class="event__show">
            <livewire:events.show.first-table />
        </div>

        {{-- Second Table --}}
        <div class="event__show__results">
            <h2 class="title">Tableau de résumé des cotes</h2>
            <livewire:events.show.second-table />
        </div>
    </main>
</div>
