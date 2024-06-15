<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicon --}}
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        {{-- Title --}}
        <title>{{ $title ?? 'Dashboard évaluateur' }}</title>

        @livewireStyles
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <header class="evaluator__header">
            <!-- Logo -->
            {{-- TODO : change the route to 'evaluator-events-dashboard' --}}
            <a href="{{ url()->current() }}" class="logo__link" title="Vers la page de toutes mes épreuves">
                <x-logo />
                <span>Jiri.app</span>
            </a>

            <!-- Name of the event -->
            <h1 class="evaluator__header__title">{{ $title ?? 'Dashboard évaluateur' }}</h1>

            <!-- Avatar of the evaluator -->
            {{-- TODO : add a route so the evaluator can change his profile --}}
            <img src="{{ asset('img/placeholder.png') }}" alt="photo de profil du contact" class="evaluator__header__img">
        </header>

        <!-- Page Content -->
        {{ $slot }}

        @livewireScriptConfig
    </body>
</html>
