<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Jiri app' }}</title>

    @livewireStyles
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
<!-- Page Navigation -->
@include('layouts.navigation')

<!-- Page Content -->
{{ $slot }}

<!-- Page Footer -->
@include('components.footer')

@livewireScriptConfig
</body>
</html>
