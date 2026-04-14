<a href="{{ route('publications.show', $publication->id) }}"
   class="block bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">

    @if($publication->image)
        <img src="{{ asset('storage/' . $publication->image) }}"
             class="w-full h-48 object-cover">
    @else
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
            Pas d'image
        </div>
    @endif

    <div class="p-5">

        <h2 class="text-lg font-bold mb-2">
            {{ $publication->titre }}
        </h2>

        <p class="text-gray-600 text-sm mb-4">
            {{ \Illuminate\Support\Str::limit($publication->contenu, 120) }}
        </p>

        <div class="flex justify-between text-xs text-gray-500">

            <span>
                {{ \Carbon\Carbon::parse($publication->created_at)->format('d/m/Y') }}
            </span>

            <span class="font-medium text-gray-700">
                {{ $publication->user->prenom ?? '' }}
                {{ $publication->user->nom ?? 'Admin' }}
            </span>

        </div>

    </div>

</a>