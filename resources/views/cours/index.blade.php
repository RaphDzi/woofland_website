<x-app-layout>
    <?php phpinfo(); ?>
    <div class="max-w-6xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-800">
                🐶 Cours Woofland
            </h1>
            <p class="text-gray-500 mt-2">
                Découvrez et réservez vos prochains cours
            </p>
        </div>

        <!-- FILTRES -->
        <form method="GET" class="mb-10 bg-white p-4 rounded-2xl shadow flex flex-col md:flex-row gap-4">
            
            <select name="type_cours" class="border rounded-lg px-3 py-2 w-full">
                <option value="">Tous les types</option>
                @foreach($typesCours as $type)
                    <option value="{{ $type }}" {{ request('type_cours') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>

            <select name="terrain" class="border rounded-lg px-3 py-2 w-full">
                <option value="">Tous les terrains</option>
                @foreach($terrains as $terrain)
                    <option value="{{ $terrain }}" {{ request('terrain') == $terrain ? 'selected' : '' }}>
                        {{ $terrain }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date"
                value="{{ request('date') }}"
                class="border rounded-lg px-3 py-2 w-full">

            <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                Filtrer
            </button>

        </form>

        <!-- GRID COURS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach($cours as $c)

                @php
                    $isInscrit = $c->inscrits->contains(auth()->id());
                    $dateCours = \Carbon\Carbon::parse($c->date . ' ' . $c->heure_debut);
                    $canCancel = now()->diffInHours($dateCours, false) >= 6;
                @endphp

                <div class="bg-white rounded-2xl shadow p-5 flex flex-col justify-between">

                    <!-- INFO -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                            {{ $c->type_cours }}
                        </h2>

                        <p class="text-sm text-gray-500 mb-2">
                            📅 {{ \Carbon\Carbon::parse($c->date)->format('d/m/Y') }}
                            - {{ $c->heure_debut }}
                        </p>

                        <p class="text-sm text-gray-600 mb-2">
                            📍 {{ $c->terrain }}
                        </p>

                        <p class="text-sm text-gray-600 mb-4">
                            👨‍🏫
                            @foreach($c->animateur as $a)
                                {{ $a->firstname }}
                            @endforeach
                        </p>
                    </div>

                    <!-- ACTION -->
                    <div class="mt-auto">

                        @if(!$isInscrit)
                            <form method="POST" action="{{ route('cours.inscrire', $c->id) }}">
                                @csrf
                                <button
                                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                                    S'inscrire
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('cours.desinscrire', $c->id) }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="w-full py-2 rounded-lg transition
                                    {{ $canCancel 
                                        ? 'bg-red-500 hover:bg-red-600 text-white' 
                                        : 'bg-gray-300 text-gray-600 cursor-not-allowed' }}"
                                    {{ !$canCancel ? 'disabled' : '' }}>
                                    
                                    {{ $canCancel ? 'Se désinscrire' : 'Trop tard (6h avant)' }}
                                </button>
                            </form>
                        @endif

                    </div>

                </div>

            @endforeach

        </div>

        <!-- MESSAGE SI VIDE -->
        @if($cours->isEmpty())
            <div class="text-center text-gray-500 mt-10">
                Aucun cours disponible 😢
            </div>
        @endif

    </div>

</x-app-layout>