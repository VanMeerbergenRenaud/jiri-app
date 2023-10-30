<x-app-layout>
    <div class="welcome__start">
        <div class="welcome__start__infos">
            <img src="{{ asset('img/dominique.png') }}" alt="Image de l'admin Dominique">
            <div>
                <h2>Bonjour Dominique !</h2>
                <p>Découvrez la liste des diverses épreuves à venir ou déjà passées.</p>
            </div>
        </div>
        <a href="{{ route('events.create') }}" class="button--classic">Créer une nouvelle épreuve</a>
    </div>
    {{-- Events --}}
    <div class="events">
        <ul class="list">
            Liste des épreuves en cours
            <li class="item">
                <h3 class="border">Jury juin 2024</h3>
                <div class="border">
                    Date de l’épreuve<br>
                    <time datetime="2023-06-21 08:30">21 juin 2023 à 8h30</time>
                </div>
                <div class="border">
                    Durée de l’épreuve<br>
                    <span>7h30</span>
                </div>
                <div class="border">
                    Participants<br>
                    <p>
                        <span>12 évaluateurs</span>
                        <span>24 évalués</span>
                    </p>
                </div>
                <div class="border">
                    <a href="/" class="edition">Édition des profils et infos</a>
                </div>
                <a href="/" class="see">Voir</a>
                {{-- Event available --}}
                {{--@if($eventIsAvailable)
                    <a href="/" class="see">Voir</a>
                @else
                    <a href="/" class="see unavailable">Non disponible</a>
                @endif--}}
            </li>
        </ul>
        {{--<div class="flex-center empty">
            <p>Aucune épreuve n’a encore été créé jusqu’à présent.</p>
            <a href="/{{ route('events.create') }}" class="underline-blue">Créer une première épreuve</a>
        </div>--}}
    </div>
</x-app-layout>
