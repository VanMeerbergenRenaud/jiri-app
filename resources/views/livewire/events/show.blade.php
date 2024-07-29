<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Évènement {{  $event->name }}</h1>
    @endsection

    <header class="header">
        <x-banner
            :title="'Épreuve : ' . $event->name"
            :message="'Votre épreuve est en cours d\'acheminement.'"
        />
    </header>

    <main class="mainEventShow max-width p-main">
        {{-- Event status action buttons --}}
        <livewire:events.show.actions :event="$event" />

        {{-- First Table --}}
        <div class="event__show">
            <livewire:events.show.first-table :event="$event" :contacts="$contacts" :evaluators="$evaluators" :students="$students" />
        </div>

        {{-- Second Table --}}
        <div class="event__show__results">
            <livewire:events.show.second-table :event="$event" :contacts="$contacts" :evaluators="$evaluators" :students="$students" :projects="$projects" />
        </div>
    </main>

    <footer class="footerEvent">
        <p>Tableau de bord de {{ auth()->user()->name ?? 'John Doe' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve du jour' }}</p>
    </footer>
</div>
