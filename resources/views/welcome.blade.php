<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

        <title>Document</title>
        @vite(['resources/css/app.scss'])
    </head>
    <body>
        <main class="mainWelcome flex-center">
            <div class="flex-center welcome">
                <div class="flex-center welcome__intro">
                    <img src="{{ auth()->user()->avatarUrl() ?? asset('img/placeholder.png') }}" alt="Photo de profil">
                    <h2>Enchanté {{ $user->name }} !</h2>
                    <p>Commencer votre aventure dès maintenant.</p>
                </div>

                <div class="flex-center welcome__login">
                    <h2>Bienvenue sur Jiri App</h2>
                    <p>
                        Il vous faut créer une épreuve afin de commencer
                        correctement à utiliser l’application.
                    </p>
                    <a href="{{ route('events.index') }}" class="button--classic">Commencer</a>
                </div>
            </div>
        </main>
    </body>
</html>
