<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Jiri app' }}</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/@alpinejs/ui@3.13.2-beta.0/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    </head>
    <body>
        <header class="sr-only">
            <h1 role="heading" aria-level="1">
                Jiri App
            </h1>
        </header>

        <!-- Page Navigation -->
        @include('layouts.navigation')

        <!-- Page Content -->
        {{ $slot }}

        <!-- Page Footer -->
        @include('layouts.footer')
    </body>
</html>
