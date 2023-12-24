<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Dashboard évaluateur' }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/@alpinejs/ui@3.13.2-beta.0/dist/cdn.min.js"></script>
    </head>
    <body>
        <header class="flex items-center justify-between gap-2 p-4 m-auto w-full" style="max-width: 1650px">
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2">
                <x-breeze.application-logo class="block w-auto fill-current" />
                <span class="font-semibold text-gray-600">Jiri.app</span>
            </a>

            {{-- Name of the event --}}
            <h1 class="font-semibold mr-8">{{ $title ?? 'Jury juin 2023' }}</h1>

            {{-- Avatar of the evaluator --}}
            <img src="{{ asset('img/dominique.png') }}" alt="" class="rounded-full h-8 w-8">
        </header>

        <!-- Page Content -->
        {{ $slot }}

        <!-- Page Footer -->
        @include('layouts.footer')
    </body>
</html>
