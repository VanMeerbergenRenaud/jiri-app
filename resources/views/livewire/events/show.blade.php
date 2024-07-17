<div>
    {{--
        Changer le layout et créer une nouvelle page avec une nouvelle navigation
        pour afficher les détails de l'évènement en cours.
        Le bouton démarrer l'évènement est dans la vue Edit d'un event qui redirigie vers cette vue

        1. Bouton pour quitter l'épreuve sans la mettre en pause et retourner au dashboard des épreuves
        2. Boutons mettre en pause ou terminer l'évènement
        3. Tableau des personnes vues (voir en plein écran)
        4. Récapitulatif général des points (voir en plein écran)
        5. Bouton pour pouvoir quitter l'épreuve et afficher ensuite l'épreuve en cours dans le dashboard
        6. Terminer les 2 autres interfaces dans Adobe XD

        Lorsque l'évènement est terminé, on redirige vers la page de l'évènement terminé
        'event.recap' par exemple
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
        <div class="event__status">
            <label for="status">Status&nbsp;:</label>
            <select id="status">
                <option value="start">En cours</option>
                <option value="pause">Mettre en pause</option>
                <option value="end">Arrêter</option>
            </select>
            {{--
                If 'en cours' -> nothing happen, the dashboard is active by default
                If 'en pause' -> modal that stop the timer and blur the interface behind
                If 'terminé' -> modal that stop the timer and end evaluation for all evaluators
            --}}
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

    <footer class="footerEvent">
        <p>Tableau de bord de {{ auth()->user()->name ?? 'John Doe' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve du jour' }}</p>
    </footer>
</div>
