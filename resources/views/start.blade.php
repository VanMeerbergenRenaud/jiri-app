<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Jiri App - Invité' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative flex justify-center items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="p-12 text-right z-10 flex flex-col justify-center align-items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="font-semibold underline text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Vous êtes déjà connecté, retourner au dashboard !
                        </a>
                    @else
                        {{-- Bienvenue sur l'apllication Jiri --}}
                        <div class="flex flex-col items-center justify-items-center">
                            <h1 class="text-3xl max-w-lg font-bold text-center text-gray-900 dark:text-white sm:text-6xl" style="line-height: 1.15">
                                Bienvenue sur l'application Jiri
                            </h1>
                            <p class="mt-12 text-lg text-center text-gray-600 dark:text-gray-400">
                                Pour commencer, veuillez vous
                                <a href="{{ route('login') }}" class="text-lg text-blue-700 hover:text-blue-900 hover:underline">connecter</a>
                                @if (Route::has('register'))ou vous
                                <a href="{{ route('register') }}" class="ml text-lg text-blue-700 hover:text-blue-900 hover:underline">inscrire</a>.
                                @endif
                            </p>
                        </div>
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
