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

        <!-- Alpine -->
        <script defer src="https://unpkg.com/@alpinejs/ui@3.13.2-beta.0/dist/cdn.min.js"></script>

        @livewireStyles
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div wire:offline class="offline">
            Vous êtes actuellement hors ligne veuillez vous reconnecter à un réseau pour continuer à utiliser l'application.
        </div>

        @yield('title')

        {{ $slot }}

        @livewireScriptConfig
    </body>
</html>
