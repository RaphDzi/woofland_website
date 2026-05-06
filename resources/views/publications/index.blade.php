<x-app-layout>

    <div class="max-w-6xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-800">
                🐾 Actualités Woofland
            </h1>
            <p class="text-gray-500 mt-2">
                Retrouvez toutes nos nouvelles et événements
            </p>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach($publications as $publication)
                <x-publication-card :publication="$publication" />
            @endforeach

        </div>

        <!-- MESSAGE SI VIDE -->
        @if($publications->isEmpty())
            <div class="text-center text-gray-500 mt-10">
                Aucune actualité disponible
            </div>
        @endif

        <!-- PAGINATION -->
        <div class="mt-10">
            {{ $publications->links() }}
        </div>

    </div>

</x-app-layout>
