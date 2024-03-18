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

        <script defer src="https://unpkg.com/@alpinejs/ui@3.13.2-beta.0/dist/cdn.min.js"></script>

        @livewireStyles
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        @yield('title')

        @include('layouts.navigation')

        <!-- Content -->
        {{ $slot }}

        @include('components.footer')

        @livewireScriptConfig
    </body>
</html>
