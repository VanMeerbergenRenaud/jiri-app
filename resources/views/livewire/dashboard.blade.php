<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Dashboard de l'administrateur</h1>
    @endsection

    <main class="mainDashboard max-width p-main">

        <section class="mainDashboard__header">
            <h2 role="heading" aria-level="2" class="sr-only">Tableau de bord de l'administrateur</h2>
            <p class="mainDashboard__header__infos">
                <span>Tableau de bord</span>
                <span>Administrateur</span>
            </p>
            <div class="mainDashboard__header__content">
                <h3 role="heading" aria-level="2" class="mainDashboard__header__content__title">
                    Salut {{ $user->name }} !
                </h3>
                <p class="mainDashboard__header__content__description">
                    Bienvenue sur votre tableau de bord.<br>
                    Vous pouvez voir ici un aperçu de vos dernières statistiques.
                </p>
                <a href="{{ route('profile.edit') }}"
                   title="Vers votre profil"
                   class="button--blue mainDashboard__header__content__link">
                    Voir mon profil
                </a>
            </div>
        </section>

        <section class="mainDashboard__tutorial">
            <h2 role="heading" aria-level="2" class="mainDashboard__tutorial__title">Tutoriel</h2>
            <p class="mainDashboard__tutorial__text">
                Vous pouvez consulter notre tutoriel pour vous aider à démarrer sur de bonnes bases et plus rapidement
                que jamais.
            </p>
            <a href="/home"
               title="Voir le tutoriel"
               class="button--blue mainDashboard__tutorial__link">
                Voir le tutoriel
            </a>
            <img src="{{ asset('img/homepage/card_2.png') }}"
                 alt="Illustration d'un tutoriel"
                 class="mainDashboard__tutorial__img">
        </section>

        <section class="mainDashboard__stats">
            <h2 role="heading" aria-level="2" class="sr-only">Vos statistiques</h2>

            @if($events->isEmpty())
                <div class="mainDashboard__stats__empty">
                    <p class="mainDashboard__stats__empty__text">
                        <span>
                            <x-svg.warning />
                            Il semblerait que vous n’ayez pas encore créé d’épreuve, veuillez commencer par cette 1ère étape.
                        </span>
                        <a href="{{ route('events.index') }}" class="button--blue" title="Créer une nouvelle épreuve">
                            Cliquez-ici
                        </a>
                    </p>
                </div>
            @else
                <div class="mainDashboard__stats__available">
                    <h3 role="heading" aria-level="3" class="mainDashboard__stats__available__title">
                        Épreuves à commencer
                    </h3>
                    <ul class="mainDashboard__stats__available__list">
                        @forelse($availableEvent as $available)
                            <li class="mainDashboard__stats__available__list__item">
                                <p class="mainDashboard__stats__available__list__item__date">
                                    <span>{{ \Carbon\Carbon::parse($available->starting_at)->format('d') }}</span>
                                    <span>{{ \Carbon\Carbon::parse($available->starting_at)->format('M') }}</span>
                                    {{-- Version in french --}}
                                    {{--<span>{{ \Carbon\Carbon::parse($available->starting_at)->locale('fr')->translatedFormat('M') }}</span>--}}
                                </p>
                                <span class="mainDashboard__stats__available__list__item__name">
                                {{ $available->name }}
                            </span>
                                <span class="mainDashboard__stats__available__list__item__duration">
                                <span>Durée prévue : {{ \Carbon\Carbon::parse($available->duration)->format('G\hi\m\i\n') }}</span>
                            </span>
                            </li>
                        @empty
                            {{--TODO : mainDashboard item__empty--}}
                            <li class="mainDashboard__stats__available__list__item__empty">
                                Aucune épreuve à commencer
                            </li>
                        @endforelse
                    </ul>
                </div>

                <ul class="mainDashboard__stats__list">
                    <li class="mainDashboard__stats__list__item">
                        {{-- icon of stat --}}
                        <div class="mainDashboard__stats__list__item__icon">
                            <x-svg.dashboard.all class="icon-all"/>
                        </div>
                        <h3 role="heading" aria-level="3" class="mainDashboard__stats__list__item__title">
                            Épreuves créées
                        </h3>
                        <p class="mainDashboard__stats__list__item__number">
                            <span>{{ $events->count() }}</span><span>/{{ $events->count() }}</span>
                        </p>
                    </li>
                    <li class="mainDashboard__stats__list__item">
                        <div class="mainDashboard__stats__list__item__icon">
                            <x-svg.dashboard.play class="icon-play"/>
                        </div>
                        <h3 role="heading" aria-level="3" class="mainDashboard__stats__list__item__title">
                            En cours
                        </h3>
                        <p class="mainDashboard__stats__list__item__number">
                            <span>{{ $currentEvent->count() }}</span><span>/{{ $events->count() }}</span>
                        </p>
                    </li>
                    <li class="mainDashboard__stats__list__item">
                        <div class="mainDashboard__stats__list__item__icon">
                            <x-svg.dashboard.pause class="icon-pause"/>
                        </div>
                        <h3 role="heading" aria-level="3" class="mainDashboard__stats__list__item__title">
                            En pause
                        </h3>
                        <p class="mainDashboard__stats__list__item__number">
                            <span>{{ $pausedEvent->count() }}</span><span>/{{ $events->count() }}</span>
                        </p>
                    </li>
                    <li class="mainDashboard__stats__list__item">
                        <div class="mainDashboard__stats__list__item__icon">
                            <x-svg.dashboard.end class="icon-end"/>
                        </div>
                        <h3 role="heading" aria-level="3" class="mainDashboard__stats__list__item__title">
                            Terminées
                        </h3>
                        <p class="mainDashboard__stats__list__item__number">
                            <span>{{ $finishedEvent->count() }}</span><span>/{{ $events->count() }}</span>
                        </p>
                    </li>
                </ul>
            @endif
        </section>
    </main>
</div>
