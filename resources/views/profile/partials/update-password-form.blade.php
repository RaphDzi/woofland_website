<section class="space-y-6">

    <!-- HEADER -->
    <header>
        <h2 class="text-xl font-bold text-gray-800">
            🔐 Sécurité du mot de passe
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Change ton mot de passe pour sécuriser ton compte Woofland.
        </p>
    </header>

    <!-- FORM -->
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">

        @csrf
        @method('put')

        <!-- CURRENT PASSWORD -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" />

            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- NEW PASSWORD -->
        <div>
            <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" />

            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                autocomplete="new-password"
            />

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- CONFIRM PASSWORD -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" />

            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                autocomplete="new-password"
            />

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- ACTION -->
        <div class="flex items-center gap-4">

            <x-primary-button class="bg-green-700 hover:bg-green-800 focus:ring-green-600">
                🔒 Mettre à jour
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >
                    ✔ Mot de passe mis à jour
                </p>
            @endif

        </div>

    </form>

</section>