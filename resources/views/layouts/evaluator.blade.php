<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Dashboard évaluateur' }}</title>

        @livewireStyles
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <header class="flex items-center justify-between gap-2 p-4 m-auto w-full" style="max-width: 1650px; border-bottom: 1px solid #E5E9F4;">
            <!-- Logo -->
            <a href="/" class="logo__link">
                <x-logo />
                <span>Jiri.app</span>
            </a>

            <!-- Name of the event -->
            <h1 class="font-semibold mr-8">{{ $title ?? 'Jury juin 2023' }}</h1>

            <!-- Avatar of the evaluator -->
            <img src="{{ asset('img/placeholder.png') }}" alt="" class="rounded-full h-8 w-8">
        </header>

        <!-- Page Content -->
        {{ $slot }}

        @livewireScriptConfig
    </body>
</html>
