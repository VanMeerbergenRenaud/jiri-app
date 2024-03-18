<nav x-data="{ open: false }" class="nav">
    <h2 aria-level="2" role="heading" class="sr-only">
        Menu de navigation principal
    </h2>

    <!-- Principal navigation menu -->
    <div class="nav__container">
        <div class="nav__container__left">
            <!-- Logo mobile & desktop-->
            <a href="{{  route('dashboard') }}" class="logo" wire:navigate title="Vers la page d'accueil">
                <x-logo />
                <span>Jiri.app</span>
            </a>

            <!-- Desktop navigation links -->
            <ul role="menu" class="navigation-links" tabindex="0">
                <li class="navigation-links__item">
                    <a href="{{ route('events.index') }}" class="navigation-links__item__link" title="Vers la page des épreuves" wire:navigate>
                        Épreuves
                    </a>
                </li>
                <li class="navigation-links__item">
                    <a href="{{ route('contacts.index') }}" class="navigation-links__item__link" title="Vers la page des contacts" wire:navigate>
                        Contacts
                    </a>
                </li>
                <li class="navigation-links__item">
                    <a href="{{ route('projects.index') }}" class="navigation-links__item__link" title="Vers la page des projets" wire:navigate>
                        Projets
                    </a>
                </li>
            </ul>
        </div>

        <!-- Desktop settings dropdown -->
        <div x-data="{ dropdownOpen: false }" class="settings-dropdown">

            <!-- Dropdown button -->
            <button @click="dropdownOpen = !dropdownOpen" class="settings-dropdown__button">
                @if(Auth::check())
                <span>{{ Auth::user()->name }}</span>
                @endif

                <x-svg.arrow-down/>
            </button>

            <!-- Dropdown content -->
            <div x-show="dropdownOpen" class="settings-dropdown__content">
                <a href="{{ route('profile.edit') }}" wire:navigate title="Vers la page d'édition du profil">
                    Profile
                </a>

                <x-divider />

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" title="Retour à la page de présentation de l'application">
                        Se déconnecter
                    </a>
                </form>
            </div>
        </div>

        <!-- Mobile hamburger -->
        <div class="hamburger">
            <button @click="open = !open" type="button" class="hamburger__button">
                Menu
            </button>
        </div>
    </div>

    <!-- Mobile navigation menu -->
    <div
        class="hidden nav__mobile"
        :class="{'block': open, 'hidden': !open}"
        x-transition:enter="ease-out duration-200"
    >

        @if(Auth::check())
            <p class="nav__mobile__user-infos">
                <span>{{ Auth::user()->name }}</span>
                <span>{{ Auth::user()->email }}</span>
            </p>
        @endif

        <x-divider/>

        <ul role="menu" class="nav__mobile__menu" tabindex="0">
            <li class="nav__mobile__menu__item">
                <a href="{{ route('profile.edit') }}" class="nav__mobile__menu__item__link"
                   title="Vers la page de profil" wire:navigate>
                    Profil
                </a>
            </li>
            <li class="nav__mobile__menu__item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" class="nav__mobile__menu__item__link" title="Se déconnecter"
                       onclick="event.preventDefault();this.closest('form').submit();">
                        Se déconnecter
                    </a>
                </form>
            </li>

            <x-divider/>

            <li class="nav__mobile__menu__item">
                <a href="{{ route('dashboard') }}" class="nav__mobile__menu__item__link"
                   title="Vers le tableau de bord">
                    Dashboard
                </a>
            </li>
            <li class="nav__mobile__menu__item">
                <a href="{{ route('events.index') }}" class="nav__mobile__menu__item__link"
                   title="Vers la page des épreuves" wire:navigate>
                    Épreuves
                </a>
            </li>
            <li class="nav__mobile__menu__item">
                <a href="{{ route('contacts.index') }}" class="nav__mobile__menu__item__link"
                   title="Vers la page des contacts" wire:navigate>
                    Contacts
                </a>
            </li>
            <li class="nav__mobile__menu__item">
                <a href="{{ route('projects.index') }}" class="nav__mobile__menu__item__link"
                   title="Vers la page des projets" wire:navigate>
                    Projets
                </a>
            </li>
        </ul>
    </div>
</nav>
