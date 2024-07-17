<div>
    <nav x-data="{ open: false }" class="nav">
        <h2 aria-level="2" role="heading" class="sr-only">
            Menu de navigation principal
        </h2>

        <!-- Principal navigation menu -->
        <div class="nav__container">
            <div class="nav__container__left">
                <!-- Logo mobile & desktop-->
                <a href="{{  route('events.show', $event) }}" class="logo" wire:navigate title="Vers le tableau de bord de l'épreuve">
                    <x-logo />
                    <span>Jiri.app</span>
                </a>

                <!-- Desktop navigation links -->
                <ul role="menu" class="navigation-links" tabindex="0">
                    <li class="navigation-links__item">
                        <a href="{{ route('events.event.dashboard.evaluators', $event) }}"
                           class="navigation-links__item__link {{ Route::currentRouteNamed('events.event.dashboard.evaluators') ? 'active' : '' }}"
                           title="Vers la page des évaluateurs de l‘épreuve" wire:navigate>
                            Évaluateurs
                        </a>
                    </li>
                    <li class="navigation-links__item">
                        <a href="{{ route('events.event.dashboard.students', $event) }}"
                           class="navigation-links__item__link {{ Route::currentRouteNamed('events.event.dashboard.students') ? 'active' : '' }}"
                           title="Vers la page des évalués de l'épreuve" wire:navigate>
                            Étudiants
                        </a>
                    </li>
                    <li class="navigation-links__item">
                        <a href="{{ route('events.event.dashboard.projects', $event) }}"
                           class="navigation-links__item__link {{ Route::currentRouteNamed('events.event.dashboard.projects') ? 'active' : '' }}"
                           title="Vers la page des projets de l'épreuve" wire:navigate>
                            Projets
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Profile img -->
            <div class="nav__links">
                @if($eventInProgress === null)
                    <form wire:submit.prevent="quitEvent">
                        @csrf

                        <button wire:click="quitEvent">
                            Quitter l'épreuve
                        </button>
                    </form>
                @else
                    <a href="{{ route('dashboard') }}" wire:navigate title="Retourner au tableau de bord">
                        <x-svg.back />
                    </a>
                @endif
            </div>
        </div>
    </nav>
</div>
