<div>
    {{--
        1. Bouton pour quitter l'épreuve sans la mettre en pause et retourner au dashboard des épreuves
        2. Boutons mettre en pause ou terminer l'évènement
        3. Tableau des personnes vues (voir en plein écran)
        4. Récapitulatif général des points (voir en plein écran)
        5. Bouton pour pouvoir quitter l'épreuve et afficher ensuite l'épreuve en cours dans le dashboard
        6. Terminer les 3 autres interfaces dans Adobe XD
    --}}

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
