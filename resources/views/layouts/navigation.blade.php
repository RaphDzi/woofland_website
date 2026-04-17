<nav x-data="{ open: false }">

    <!-- HEADER -->
    <header class="bg-green-700 rounded-2xl mx-6">
        <div class="flex justify-between items-center px-8  py-4 text-white">

            <!-- LOGO -->
            <a href="/">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logos/logo_woofland.png') }}" class="w-12 h-12" alt="Logo">
                    <h1 class="text-2xl font-semibold">WoofLand</h1>
                </div>
            </a>

            <!-- MENU DESKTOP -->
            <nav class="hidden sm:flex items-center space-x-3 text-sm">
                <a href="{{ route('publications.index') }}" class="hover:underline">Actualités</a>
                <span>-</span>
                <a href="{{ route('about') }}" class="hover:underline">A propos</a>
                <span>-</span>

                @auth

                    {{-- MENU ADMIN --}}
                    @if(Auth::user()->role === 'admin')
                        <div x-data="{ openAdmin: false }" class="relative inline-block">

                            <button @click="openAdmin = !openAdmin" class="hover:underline flex items-center gap-1">
                                Administration <span>▾</span>
                            </button>

                            <div x-show="openAdmin" @click.away="openAdmin = false"
                                class="absolute top-6 left-0 bg-white text-black rounded-lg shadow-lg w-52 py-2 z-50">
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    Dashboard
                                </a>

                                <a href="{{ route('admin.cours.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    Gestion des cours
                                </a>

                                <a href="{{ route('admin.publications.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    Gestion des publications
                                </a>

                                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    Gestion des membres
                                </a>
                            </div>
                        </div>

                        <span>-</span>
                    @endif


                    {{-- LIENS USER NORMAL --}}
                    <a href="{{ route('cours.index') }}" class="hover:underline">Cours</a>
                    <span>-</span>

                    <a href="{{ route('profile.edit') }}" class="hover:underline">
                        {{ Auth::user()->username }}
                    </a>
                    <span>-</span>

                    <a href="{{ route('messages.index') }}" class="hover:underline">💬</a>
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
            <a href="{{ route('cours.index') }}" class="block">Cours</a>

            <a href="{{ route('messages.index') }}" class="block">💬</a>

            <div>{{ Auth::user()->username }}</div>

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