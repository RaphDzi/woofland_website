<nav x-data="{ open: false }">

    <!-- HEADER -->
    <header class="bg-green-700 rounded-2xl mx-6">
        <div class="flex justify-between items-center px-8  py-4 text-white">

            <!-- LOGO -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logos/logo_woofland.png') }}" class="w-12 h-12" alt="Logo">
                <h1 class="text-2xl font-semibold">WoofLand</h1>
            </div>

            <!-- MENU DESKTOP -->
            <nav class="hidden sm:flex items-center space-x-3 text-sm">
                <a href="/" class="hover:underline">Accueil</a>
                <span>-</span>
                <a href="{{ route('publications.index') }}" class="hover:underline">Actualités</a>
                <span>-</span>
                <a href="{{ route('about') }}" class="hover:underline">A propos</a>
                <span>-</span>

                @auth
                    <a href="{{ route('profile.edit') }}" class="hover:underline">{{ Auth::user()->username }}</a>
                    <span>-</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="hover:underline">
                            Déconnexion
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Connexion</a>
                    <span>-</span>
                    <a href="{{ route('register') }}" class="hover:underline">Inscription</a>
                @endauth
            </nav>

            <!-- BURGER -->
            <div class="sm:hidden">
                <button @click="open = !open">
                    ☰
                </button>
            </div>

        </div>
    </header>

    <!-- MENU MOBILE -->
    <div x-show="open" class="sm:hidden bg-green-700 mx-6 mt-2 rounded-xl text-white p-4 space-y-2">

        <a href="/" class="block">Accueil</a>
        <a href="{{ route('publications.index') }}" class="block">Actualités</a>
        <a href="{{ route('about') }}" class="block">A propos</a>


        <hr class="border-white/30">

        @auth
            <div>{{ Auth::user()->name }}</div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button onclick="event.preventDefault(); this.closest('form').submit();">
                    Déconnexion
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}">Inscription</a>
        @endauth

    </div>

</nav>