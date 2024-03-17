<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicon --}}
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        {{-- Title --}}
        <title>{{ $title ?? 'Jiri App - Accueil' }}</title>

        @livewireStyles
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
        <!-- Body -->
        @yield('content')

        @livewireScriptConfig
        @yield('scripts')
</html>
