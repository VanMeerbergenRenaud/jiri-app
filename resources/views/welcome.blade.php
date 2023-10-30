<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

        <title>Document</title>
        @vite(['resources/css/app.scss'])
    </head>
    <body>
        <x-app-layout>
            <div class="welcome">
                <div class="welcome__intro">
                    <img src="https://media.istockphoto.com/id/125141451/fr/photo/grand-dadais-en-donnant-une-fleur.jpg?s=612x612&w=0&k=20&c=6kRaCDLMue4VCUVZAo_ZCKdXy60tuVX-59HzoL1NXyY=" alt="">
                    <h2>Joyeux anniversaire Dominique !</h2>
                    <p>Commencer votre aventure dès maintenant.</p>
                </div>

                <div class="welcome__login">
                    <h2>Bienvenue sur Jiri App</h2>
                    <p>
                        Il vous faut créer une épreuve afin de commencer
                        correctement à utiliser l’application.
                    </p>
                    <button class="button--classic">Commencer</button>
                </div>
            </div>
        </x-app-layout>
    </body>
</html>
