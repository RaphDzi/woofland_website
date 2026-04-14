<section class="space-y-6">

    <!-- HEADER -->
    <header>
        <h2 class="text-xl font-bold text-gray-800">
            📍 Adresse
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Mets à jour ton adresse pour les cours et interventions Woofland.
        </p>
    </header>

    <!-- FORM -->
    <form method="post" action="{{ route('profile.address.update') }}" class="space-y-6">

        @csrf
        @method('patch')

        <!-- VOIE -->
        <div>
            <x-input-label for="voie" value="Adresse (voie)" />

            <x-text-input id="voie" name="voie" type="text"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                :value="old('voie', $user->adresse->voie ?? '')" autocomplete="street-address" />

            <x-input-error :messages="$errors->get('voie')" class="mt-2" />
        </div>

        <!-- CODE POSTAL -->
        <div>
            <x-input-label for="code_postal" value="Code postal" />

            <x-text-input id="code_postal" name="code_postal" type="text"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                :value="old('code_postal', $user->adresse->code_postal ?? '')" autocomplete="postal-code" />

            <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
        </div>

        <!-- VILLE -->
        <div>
            <x-input-label for="ville" value="Ville" />

            <x-text-input id="ville" name="ville" type="text"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                :value="old('ville', $user->adresse->ville ?? '')" autocomplete="address-level2" />

            <x-input-error :messages="$errors->get('ville')" class="mt-2" />
        </div>

        <!-- COMPLEMENT -->
        <div>
            <x-input-label for="complement" value="Complément d'adresse" />

            <x-text-input id="complement" name="complement" type="text"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                :value="old('complement', $user->adresse->complement ?? '')" autocomplete="address-line2" />

            <x-input-error :messages="$errors->get('complement')" class="mt-2" />
        </div>

        <!-- SAVE -->
        <div>
            <x-primary-button class="bg-green-700 hover:bg-green-800 focus:ring-green-600">
                💾 Enregistrer l’adresse
            </x-primary-button>
        </div>
        @if (session('status') === 'address-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600">
                ✔ Sauvegardé
            </p>
        @endif
    </form>
</section>