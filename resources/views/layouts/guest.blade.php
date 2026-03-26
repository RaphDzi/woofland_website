<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-sans antialiased bg-white">

    <header class="bg-green-800 px-10 py-2 rounded-b-3xl">
        <div class=" mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logos/logo_woofland.png') }}" class="w-28 h-28" alt="Logo">
                <h1 class="text-white text-3xl">WoofLand</h1>
            </div>

            <nav class="text-white space-x-4 underline">
                <a href="{{ route('register') }}">Inscription</a>
                <a href="{{ route('login') }}">Connexion</a>
            </nav>
        </div>
    </header>

    <div class="text-white text-xl underline">
        Inscription - Connexion
    </div>
    </div>
    {{ $slot }}
</body>

</html>