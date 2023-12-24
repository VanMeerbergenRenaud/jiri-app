<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Jiri app' }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/@alpinejs/ui@3.13.2-beta.0/dist/cdn.min.js"></script>
    </head>
    <body>
        <!-- Page Navigation -->
        @include('layouts.navigation')

        <!-- Page Content -->
        {{ $slot }}

        <!-- Page Footer -->
        @include('layouts.footer')
    </body>
</html>
