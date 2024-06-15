<div>
    @section('content')
        <body class="homepage">
        <header class="homepage__header" role="banner">
            <h1 role="heading" aria-level="1" class="sr-only">Jiri app</h1>

            <!-- Navigation -->
            <nav class="homepage__header__nav" role="navigation"
                 aria-label="Menu de navigation pour l'inscription ou la connection" itemscope
                 itemtype="http://schema.org/SiteNavigationElement" tabindex="0">
                <h2 role="heading" aria-level="2" class="sr-only">Menu de navigation</h2>
                <div class="logo">
                    <!-- Logo -->
                    <a href="/" class="logo__link" title="Retour à l'accueil">
                        <x-logo/>
                        <span>Jiri.app</span>
                    </a>
                </div>

                <div x-data="{ dropdownOpen: false, isDesktop: window.innerWidth > 815 }" class="homepage__header__nav__dropdown">
                    <button @click="dropdownOpen = !dropdownOpen" class="homepage__header__nav__button">Menu</button>
                    <ul role="menu"
                        x-show="dropdownOpen || isDesktop"
                        @click.away="dropdownOpen = false"
                        x-transition:enter="ease-out duration-200"
                        class="homepage__header__nav__menu"
                        tabindex="0"
                    >
                        <li itemscope itemtype="http://schema.org/SiteNavigationElement">
                            <a href="#features" @click="dropdownOpen = false" tabindex="0"
                               title="Vers la section des fonctionnalités" itemprop="url">
                                <span itemprop="name">Fonctionnalités</span>
                            </a>
                        </li>
                        <li itemscope itemtype="http://schema.org/SiteNavigationElement">
                            <a href="#benefits" @click="dropdownOpen = false" tabindex="0"
                               title="Vers la section des avantages" itemprop="url">
                                <span itemprop="name">Avantages</span>
                            </a>
                        </li>
                        <li itemscope itemtype="http://schema.org/SiteNavigationElement">
                            <a href="#pricing" @click="dropdownOpen = false" tabindex="0" title="Vers la section des prix"
                               itemprop="url">
                                <span itemprop="name">Prix</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="homepage__header__nav__links">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" title="Vers la page de connexion"
                               class="link--blue">Connexion</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" title="Vers la page d'inscription" class="link--blue">Inscription</a>
                        @endif
                    @endguest
                </div>
            </nav>
        </header>

        <main class="homepage__main" role="main">
            @auth
                <a class="" href="{{ route('dashboard') }}">Vous êtes déjà connecté, retourner au dashboard&nbsp;!</a>
            @endauth

            <!-- Introduction -->
            <section class="homepage__main__intro">
                <h2 role="heading" aria-level="2" class="homepage__main__intro__title">
                    Gérez facilement votre jury académique
                </h2>
                <p class="homepage__main__intro__text">
                    Simplifiez-vous la vie, gagner du temps sur la cotation des projets présentés par vos étudiants.
                </p>
                <a href="{{ route('register') }}" title="Vers la page d'inscription"
                   class="link--blue homepage__main__intro__link">
                    Essayer la version gratuite
                </a>

                <div class="homepage__main__intro__img">
                    <img src="{{ asset('img/homepage/homepage.jpg') }}" alt="image" width="508" height="878">
                </div>
            </section>

            <!-- Features -->
            <section class="homepage__main__features reveal" id="features">
                <div class="homepage__main__features__container">
                    <span class="subtitle">Fonctionnalités</span>
                    <h2 role="heading" aria-level="2" class="title">
                        Suivi en live des épreuves en cours
                    </h2>
                    <p class="text">
                        L'application est réactive à chaque action et ne produit aucun rechargement de la page.
                        Compatible avec chacun de vos navigateurs, Jiri vous permettra de gagner du temps lors de
                        l'organisation d'une épreuve.
                    </p>
                    <div class="homepage__main__features__container__card card-1 reveal">
                        <h3 role="heading" aria-level="3" class="small-title">
                            Bien meilleur que le logiciel Excel
                        </h3>
                        <p class="small-text">
                            Découvrez des tableaux qui résumeront les projets, notes et commentaires chaque étudiant
                            actualisé en temps réel.
                        </p>

                        <!-- Image for mobile -->
                        <a href="{{ asset('register') }}" title="Vers la page d'inscription">
                            <img src="{{ asset('img/homepage/card_1_mobile.png') }}" class="mobile-img" alt="image d'un tableau de bord">
                        </a>

                        <!-- Image for desktop -->
                        <a href="{{ route('register') }}" title="Vers la page d'inscription">
                            <img src="{{ asset('img/homepage/card_1_desktop.png') }}" class="desktop-img" alt="image d'un tableau de bord">
                        </a>

                        <a href="{{ route('register') }}" title="Vers la page d'inscription" class="link--blue">
                            Essayer maintenant
                        </a>
                    </div>

                    <div class="homepage__main__features__container__card card-2 reveal">
                        <h3 role="heading" aria-level="3" class="small-title">
                            Enregistrement
                        </h3>
                        <p class="small-text">
                            Formulaires conviviaux pour la création des épreuves, des contacts et des projets.
                        </p>
                    </div>

                    <div class="homepage__main__features__container__card card-3 reveal">
                        <h3 role="heading" aria-level="3" class="small-title">
                            Automatisation
                        </h3>
                        <p class="small-text">
                            Calculs automatisés des notes pour chaque projet présenté pour chacun de vos étudiants.
                        </p>
                        <img src="{{ asset('img/homepage/card_3.png') }}" alt="image d'un tableau de bord">
                    </div>

                    <!-- Languages -->
                    <section class="homepage__main__features__container__languages reveal">
                        <h2 role="heading" aria-level="2" class="homepage__main__features__container__languages__title">
                            Languages et technologies utilisées
                        </h2>
                        <div class="homepage__main__features__container__languages__list">
                            <div class="homepage__main__features__container__languages__list__item">
                                @foreach ($logos as $logo)
                                    {!! $logo !!}
                                @endforeach
                            </div>
                        </div>
                        <p class="homepage__main__features__container__languages__text">
                            Jiri est l'application la moins utilisée de 2024
                        </p>
                    </section>
                </div>
            </section>

            <!-- Examples -->
            <article class="homepage__main__examples">
                <h2 role="heading" aria-level="2" class="sr-only">
                    Examples
                </h2>

                @foreach($examples as $key => $example)
                    <section class="homepage__main__examples__section {{ $key % 2 == 0 ? '' : 'odd' }} reveal">
                        <div class="homepage__main__examples__section__container reveal">
                            <span class="subtitle">
                                {!! $example['icon'] !!}
                                {{ $example['subtitle'] }}
                            </span>
                            <h3 role="heading" aria-level="3" class="title">
                                {{ $example['title'] }}
                            </h3>
                            <p class="text">
                                {{ $example['text'] }}
                            </p>
                            <a href="{{ $example['url'] }}" title="Vers la page d'inscription"
                               class="homepage__main__examples__section__container__link">
                                En savoir plus
                            </a>
                        </div>
                        <img src="{{ $example['image'] }}"
                             alt="présentation d'un tableau complet dans l'application">
                    </section>
                @endforeach
            </article>

            <!-- Benefits -->
            <section class="homepage__main__benefits reveal" id="benefits">
                <span class="subtitle">Avantages</span>
                <h2 role="heading" aria-level="2" class="title">
                    Une application conçue pour vous
                </h2>

                <div class="homepage__main__benefits__container">
                    <ul class="homepage__main__benefits__container__list">
                        @foreach ($benefits as $benefit)
                            <li class="homepage__main__benefits__container__list__item reveal">
                                {!! $benefit['icon'] !!}
                                <h3 role="heading" aria-level="3" class="small-title">
                                    {{ $benefit['title'] }}
                                </h3>
                                <p class="small-text">
                                    {{ $benefit['text'] }}
                                </p>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Example of benefit -->
                    <div class="homepage__main__benefits__container__img reveal">
                        <img src="{{  asset("img/homepage/stats.png") }}"
                             alt="image de l'appli">
                        <a href="/" title="Vers la page d'inscription" class="link--blue">
                            Commencer
                        </a>
                    </div>
                </div>

                <!-- Introduction of stats -->
                <div class="homepage__main__benefits__statistics reveal">
                    <span class="subtitle">Derniers faits</span>
                    <h2 role="heading" aria-level="2" class="title">
                        Nous changeons votre organisation avec simplicité
                    </h2>
                    <p class="text">
                        Dans l'apprentissage, la communication et la gestion de projets, Jiri est la solution
                        pour vous. Découvrez les derniers faits et chiffres. Nous sommes là pour vous simplifier la vie.
                    </p>

                    <!-- Statistics -->
                    <div class="homepage__main__benefits__statistics__container reveal">
                        <ul>
                            @foreach ($statistics as $statistic)
                                <li>
                                    {!! $statistic['icon'] !!}
                                    <span>{{ $statistic['title'] }}</span>
                                    <strong>{{ $statistic['number'] }}</strong>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
            <!-- Pricing -->
            <section class="homepage__main__pricing reveal" id="pricing">
                <span class="subtitle">Prix</span>
                <h2 role="heading" aria-level="2" class="title">
                    Choisissez un plan. Allez plus vite avec Jiri.
                </h2>
                <div class="homepage__main__pricing__card reveal">
                    <div class="content">
                        <h3 class="content__title small-title" role="heading" aria-level="3">
                            Adhésion à vie
                        </h3>
                        <p class="content__text">
                            Découvrez les fonctionnalités de Jiri et commencez à gérer vos épreuves en toute simplicité. Il n'y a pas de frais cachés, tout est gratuit.
                        </p>
                        <p class="content__divider">
                            <span class="content__divider__text">Ce qui est inclus !</span>
                            <span class="content__divider__line"></span>
                        </p>
                        <ul class="content__list">
                            <li class="content__list__item">
                                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/>
                                </svg>
                                <span>Accès au forum privé</span>
                            </li>
                            <li class="content__list__item">
                                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/>
                                </svg>
                                <span>Ressources illimitées</span>
                            </li>
                            <li class="content__list__item">
                                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/>
                                </svg>
                                <span>Version suivante gratuite</span>
                            </li>
                            <li class="content__list__item">
                                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/>
                                </svg>
                                <span>T-shirt offert</span>
                            </li>
                        </ul>
                    </div>
                    <div class="price">
                        <h3 class="price__title" role="heading" aria-level="3">
                            Un essai gratuit à vie
                        </h3>
                        <p class="price__text">
                            <strong>€0.00</strong>
                            <span>euro</span>
                        </p>
                        <a href="{{ route('register') }}" class="link--blue price__link">Avoir accès</a>
                        <small class="price__disclaimer">
                            Factures et reçus disponibles pour un remboursement facile par l'entreprise en cas d'erreur.
                        </small>
                    </div>
                </div>
            </section>
            <!-- FAQ -->
            <section class="homepage__main__faq reveal">
                <span class="subtitle">FAQ</span>
                <h2 role="heading" aria-level="2" class="title">
                    Questions fréquemment posées
                </h2>
                <p class="text">
                    Nous répondons aux requêtes courantes, démystifions les subtilités et fournissons des informations pour
                    vous guider dans nos services.
                </p>
                <ul id="accordion" class="accordion">
                    @foreach ($faqs as $key => $faq)
                        <li class="reveal">
                            <input type="checkbox" id="item{{ $key }}" name="accordion{{ $key }}">
                            <label for="item{{ $key }}">
                                {{ $faq['question'] }}
                            </label>
                            <p>
                                {{ $faq['answer'] }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            </section>
            <!-- CTA -->
            <section class="homepage__main__cta reveal">
                <h2 role="heading" aria-level="2" class="homepage__main__cta__title">
                    Prêt à créer le jury académique de vos rêves ?
                </h2>
                <a href="/" title="Vers la page d'inscription" class="link--blue homepage__main__cta__link">
                    Commencer
                </a>
            </section>
        </main>

        <x-footer class="homepage__footer">
            2024 Renaud Vmb. Tous droits réservés.
        </x-footer>
        </body>
    @endsection

    @section('scripts')
        <script>
            function scrollReveal() {
                const revealLine = 150;
                const revealElement = document.querySelectorAll(".reveal");
                for (let i = 0; i < revealElement.length; i++) {
                    const windowHeight = window.innerHeight;
                    const revealTop = revealElement[i].getBoundingClientRect().top;
                    if (revealTop < windowHeight - revealLine) {
                        revealElement[i].classList.add("active");
                    } else {
                        revealElement[i].classList.remove("active");
                    }
                }
            }

            window.addEventListener("scroll", scrollReveal);
        </script>
    @endsection
</div>
