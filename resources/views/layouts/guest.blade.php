<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Bienvenue sur Jiri App' }}</title>

        @livewireStyles
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <main class="guest">
            <div class="logo">
                <!-- Logo -->
                <a href="/" title="Retour à l'accueil" class="logo__link">
                    <x-logo />
                    <span>Jiri.app</span>
                </a>
            </div>

            <!-- Page Content -->
            {{ $slot }}
        </main>

        @livewireScriptConfig
    </body>
</html>
