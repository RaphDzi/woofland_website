<section class="space-y-6">

    <!-- HEADER -->
    <header>
        <h2 class="text-xl font-bold text-red-600">
            ⚠️ Zone dangereuse
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            La suppression de ton compte est définitive. Toutes tes données seront perdues.
            Pense à sauvegarder ce que tu souhaites conserver avant de continuer.
        </p>
    </header>

    <!-- DELETE BUTTON -->
    <x-danger-button
        class="bg-red-600 hover:bg-red-700 focus:ring-red-500"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        🗑️ Supprimer mon compte
    </x-danger-button>

    <!-- MODAL -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-6">

            @csrf
            @method('delete')

            <!-- TITLE -->
            <h2 class="text-xl font-bold text-gray-800">
                ❌ Confirmation de suppression
            </h2>

            <p class="text-sm text-gray-500">
                Cette action est irréversible. Pour confirmer, entre ton mot de passe.
            </p>

            <!-- PASSWORD -->
            <div>
                <x-input-label for="password" value="Mot de passe" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500"
                    placeholder="Mot de passe"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <!-- ACTIONS -->
            <div class="flex justify-end gap-3">

                <x-secondary-button
                    x-on:click="$dispatch('close')"
                    class="rounded-lg"
                >
                    Annuler
                </x-secondary-button>

                <x-danger-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500">
                    💥 Supprimer définitivement
                </x-danger-button>

            </div>

        </form>

    </x-modal>

</section>