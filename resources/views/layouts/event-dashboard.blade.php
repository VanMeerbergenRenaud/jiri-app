<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Renaud Vmb">
        <meta name="description" content="Jiri est une application web qui permet de gérer des évaluations de projets réalisés par des étudiants.">
        <meta name="keywords" content="jury, évaluation, projet, étudiant, école, application">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <!-- Title -->
        <title>{{ __('Jiri app') }}</title>

        <!-- Alpine -->
        <script defer src="https://unpkg.com/@alpinejs/ui@3.13.2-beta.0/dist/cdn.min.js"></script>

        @livewireStyles
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div wire:offline>
            Vous êtes actuellement hors ligne veuillez vous reconnecter à un réseau pour continuer à utiliser l'application.
        </div>

        @yield('title')

        <nav x-data="{ open: false }" class="nav">
            <h2 aria-level="2" role="heading" class="sr-only">
                Menu de navigation principal
            </h2>

            <!-- Principal navigation menu -->
            <div class="nav__container">
                <div class="nav__container__left">
                    <!-- Logo mobile & desktop-->
                    <a href="{{  route('events.show', $event = 46) }}" class="logo" wire:navigate title="Vers le tableau de bord de l'épreuve">
                        <x-logo />
                        <span>Jiri.app</span>
                    </a>

                    <!-- Desktop navigation links -->
                    <ul role="menu" class="navigation-links" tabindex="0">
                        <li class="navigation-links__item">
                            <a href="{{ route('events.event.dashboard.evaluators', $event = 46) }}"
                               class="navigation-links__item__link {{ Route::currentRouteNamed('events.event.dashboard.evaluators') ? 'active' : '' }}"
                               title="Vers la page des évaluateurs de l‘épreuve" wire:navigate>
                                Évaluateurs
                            </a>
                        </li>
                        <li class="navigation-links__item">
                            <a href="{{ route('events.event.dashboard.students', $event = 46) }}"
                               class="navigation-links__item__link {{ Route::currentRouteNamed('events.event.dashboard.students') ? 'active' : '' }}"
                               title="Vers la page des évalués de l'épreuve" wire:navigate>
                                Étudiants
                            </a>
                        </li>
                        <li class="navigation-links__item">
                            <a href="{{ route('events.event.dashboard.projects', $event = 46) }}"
                               class="navigation-links__item__link {{ Route::currentRouteNamed('events.event.dashboard.projects') ? 'active' : '' }}"
                               title="Vers la page des projets de l'épreuve" wire:navigate>
                                Projets
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Profile img -->
                <div class="nav__links">
                    {{--
                    <a href="{{ route('profile.edit') }}" wire:navigate title="Vers la page d'édition du profil">
                        <img src="{{ auth()->user()->github_avatar ?? asset('img/default-avatar.png') }}" alt="photo de profil de l'admin">
                    </a>
                    --}}
                    <button>
                        Quitter l'épreuve
                    </button>
                </div>
            </div>

            <!-- Mobile navigation menu -->
            <div class="hidden nav__mobile">
                <a href="{{ route('profile.edit') }}" wire:navigate title="Vers la page d'édition du profil">
                    <img src="{{ auth()->user()->github_avatar ?? asset('img/default-avatar.png') }}" alt="photo de profil de l'admin">
                </a>
            </div>
        </nav>

        <!-- Content -->
        {{ $slot }}

        <footer class="footerEvent">
            <p>Tableau de bord de {{ auth()->user()->name ?? 'John Doe' }}</p>
            <p class="copyright">Copyright - Tous droits réservés</p>
            <p>Épreuve - {{ $event->name ?? 'Épreuve du jour' }}</p>
        </footer>

        @livewireScriptConfig
    </body>
</html>
