@extends('layouts.home')

@section('content')
    <body>
        <main class="flex-center mainWelcome">
            <div class="flex-center welcome">
                <div class="flex-center welcome__intro">
                    <img src="{{ auth()->user()->avatarUrl() ?? asset('img/placeholder.png') }}" alt="Photo de profil">
                    <h1 role="heading" aria-level="1">Enchanté {{ $user->name }} !</h1>
                    <p>Commencer votre aventure dès maintenant.</p>
                </div>

                <div class="flex-center welcome__login">
                    <h2 role="heading" aria-level="2">Bienvenue sur Jiri App</h2>
                    <p>
                        Il vous faut créer une épreuve afin de commencer correctement à utiliser l’application.
                    </p>
                    <a href="{{ route('events.index') }}" class="button--classic">Commencer</a>
                </div>
            </div>
        </main>
    </body>
@endsection
