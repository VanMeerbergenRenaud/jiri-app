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
        <header class="evaluator__header" style="max-width: 1650px; border-bottom: 1px solid #E5E9F4;">
            <!-- Logo -->
            <a href="/" class="logo__link">
                <x-logo />
                <span>Jiri.app</span>
            </a>

            <!-- Name of the event -->
            <h1 class="evaluator__header__title">{{ $title ?? 'Jury juin 2023' }}</h1>

            <!-- Avatar of the evaluator -->
            <img src="{{ asset('img/placeholder.png') }}" alt="" class="evaluator__header__img">
        </header>

        <!-- Page Content -->
        {{ $slot }}

        @livewireScriptConfig
    </body>
</html>
