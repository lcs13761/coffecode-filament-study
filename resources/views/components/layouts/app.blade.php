<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">


    <meta name="application-name" content="{{ config('app.name') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <title>{{ config('app.name') }}</title>

    @filamentScripts
    @filamentStyles
    @vite('resources/css/app.css')
    @stack('styles')
    @livewireStyles
</head>
<body class="antialiased flex flex-col h-full">

@include('components.layouts.header')

<!-- Page Content -->
<main>
    {{ $slot }}
</main>


<!--FOOTER-->
@include('components.layouts.footer')
@livewire('notifications')

@vite('resources/js/app.js')
@stack('scripts')
@livewireScripts
</body>
</html>
