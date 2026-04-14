<section class="space-y-6">

    <!-- HEADER -->
    <header>
        <h2 class="text-xl font-bold text-gray-800">
            🐕 Tes chiens
        </h2>

        <p class="text-sm text-gray-500">
            Gère les informations de tes compagnons 🐾
        </p>
    </header>

    <!-- SI AUCUN CHIEN -->
    @if ($chiens->isEmpty())

        <div class="bg-gray-50 p-6 rounded-xl text-center">
            <p class="text-gray-600 mb-4">
                Tu n’as pas encore ajouté de chien 🐶
            </p>

            <form method="POST" action="{{ route('profile.dog.store') }}">
                @csrf

                <x-primary-button class="bg-green-700 hover:bg-green-800">
                    ➕ Ajouter mon premier chien
                </x-primary-button>
            </form>
        </div>

    @else

        <!-- LISTE DES CHIENS -->
        <div class="space-y-6">

            @foreach ($chiens as $chien)

                <div class="bg-white shadow-md rounded-2xl p-6">

                    <!-- UPDATE FORM -->
                    <form method="POST" action="{{ route('profile.dog.update', $chien->id) }}" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div>
                                <x-input-label value="Nom" />
                                <x-text-input name="nom"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                                    :value="old('nom', $chien->nom)" />
                            </div>

                            <div>
                                <x-input-label value="Âge" />
                                <x-text-input type="number" name="age"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                                    :value="old('age', $chien->age)" />
                            </div>

                            <div>
                                <x-input-label value="Race" />
                                <x-text-input name="race"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                                    :value="old('race', $chien->race)" />
                            </div>

                        </div>

                        <!-- SAVE -->
                        <div class="mt-4">
                            <x-primary-button class="bg-green-700 hover:bg-green-800">
                                💾 Enregistrer
                            </x-primary-button>
                        </div>

                    </form>

                    <!-- DELETE FORM (EN DEHORS) -->
                    <form method="POST" action="{{ route('profile.dog.delete', $chien->id) }}" class="mt-2">
                        @csrf
                        @method('delete')

                        <button class="text-red-600 hover:text-red-800 text-sm">
                            🗑️ Supprimer
                        </button>
                    </form>

                </div>

            @endforeach

        </div>

        <!-- ADD NEW DOG -->
        <form method="POST" action="{{ route('profile.dog.store') }}">
            @csrf

            <x-primary-button class="bg-green-700 hover:bg-green-800">
                ➕ Ajouter un chien
            </x-primary-button>
        </form>

        @if (session('status') === 'dog-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600">
                ✔ Sauvegardé
            </p>
        @endif

    @endif

</section>