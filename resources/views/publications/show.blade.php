<x-app-layout>

    <div class="max-w-4xl mx-auto mt-10 bg-white rounded-2xl shadow-md overflow-hidden">

        @if($publication->image)
            <img src="{{ asset('storage/' . $publication->image) }}"
                 class="w-full h-80 object-cover">
        @endif

        <div class="p-6">

            <h1 class="text-3xl font-bold mb-4">
                {{ $publication->titre }}
            </h1>

            <p class="text-gray-500 text-sm mb-6">
                {{ \Carbon\Carbon::parse($publication->created_at)->format('d/m/Y') }}
                • {{ $publication->formateur->prenom ?? '' }} {{ $publication->formateur->nom ?? '' }}
            </p>

            <div class="text-gray-700 leading-relaxed">
                {!! nl2br(e($publication->contenu)) !!}
            </div>

        </div>

    </div>

</x-app-layout>