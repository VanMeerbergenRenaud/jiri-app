<x-app-layout>
    <main class="mainEvents">
        <div class="events__intro">
            <div class="events__intro__info">
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
                    <h3 class="item__name">Jury juin 2024</h3>
                    <div class="item__date">
                        Date de l’épreuve<br>
                        <time datetime="2023-06-21 08:30">21 juin 2023 à 8h30</time>
                    </div>
                    <div class="item__time">
                        Durée de l’épreuve<br>
                        <span>7h30</span>
                    </div>
                    <div class="item__members">
                        Participants<br>
                        <p>
                            <span>12 évaluateurs</span> &nbsp;|&nbsp;
                            <span>24 évalués</span>
                        </p>
                    </div>
                    <a href="/" class="item__edition">Édition des profils et infos</a>
                    <a href="/" class="item__see">Voir</a>
                    {{--<a href="#" class="item__unavailable">Non disponible</a>--}}
                </li>
            </ul>
            {{--<div class="flex-center empty">
                <p>Aucune épreuve n’a encore été créé jusqu’à présent.</p>
                <a href="{{ route('events.create') }}" class="underline-blue">Créer une première épreuve</a>
            </div>--}}
        </div>
    </main>
</x-app-layout>
