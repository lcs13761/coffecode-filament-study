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

<article
    class="mt-10 pt-5 bg-cover bg-[url('https://www.cafecontrol.com.br/themes/cafeweb/assets/images/footer-bg.jpg')]">
    <div class="text-center max-w-full py-5 m-auto block" style="width: 500px">
        <h2 class="text-3xl font-black">Comece a controlar suas contas agora mesmo</h2>
        <p class="mt-5 mb-10">É rápido, simples e gratuito!</p>
        <a href="https://www.cafecontrol.com.br/cadastrar"
           class="inline-block cursor-pointer px-10 py-4 text-lg shadow decoration-0 text-white font-bold rounded"
           style="background: linear-gradient(to right,#42E695 0%,#3BB2B8 50%,#42E695 100%);">Quero
            controlar</a>
    </div>
</article>

<!--FOOTER-->
@include('components.layouts.footer')
@livewire('notifications')

@vite('resources/js/app.js')
@stack('scripts')
@livewireScripts
</body>
</html>
