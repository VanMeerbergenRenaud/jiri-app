@extends('layouts.home')

@section('content')
    <body class="welcome">
        <main class="welcome__main">
            <div class="welcome__container">
                <div class="welcome__container__intro">
                    <img src="{{ auth()->user()->avatarUrl() ?? asset('img/placeholder.png') }}" class="welcome__container__intro__img" alt="Photo de profil">
                    <h1 role="heading" aria-level="1" class="welcome__container__intro__title">Enchanté {{ $user->name }} !</h1>
                    <p class="welcome__container__intro__text">Commencer votre aventure dès maintenant.</p>
                </div>

                <div class="welcome__container__login">
                    <h2 role="heading" aria-level="2" class="welcome__container__login__title">Bienvenue sur Jiri App</h2>
                    <p class="welcome__container__login__text">Il vous faut créer une épreuve afin de commencer correctement à utiliser l’application.</p>
                    <a href="{{ route('events.index') }}" class="welcome__container__login__link button--classic">Commencer</a>
                </div>
            </div>
        </main>
        <x-footer class="welcome__footer" />
    </body>
@endsection
