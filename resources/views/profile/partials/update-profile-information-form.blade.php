<section class="space-y-6">

    <!-- HEADER -->
    <header>
        <h2 class="text-xl font-bold text-gray-800">
            👤 Informations du profil
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Mets à jour tes informations personnelles et ton adresse email.
        </p>
    </header>

    <!-- FORM -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">

        @csrf
        @method('patch')

        <!-- FIRSTNAME -->
        <div>
            <x-input-label for="firstname" value="Prénom" />

            <x-text-input
                id="firstname"
                name="firstname"
                type="text"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                :value="old('firstname', $user->firstname)"
                required
                autocomplete="given-name"
            />

            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
        </div>

        <!-- LASTNAME -->
        <div>
            <x-input-label for="lastname" value="Nom de famille" />

            <x-text-input
                id="lastname"
                name="lastname"
                type="text"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                :value="old('lastname', $user->lastname)"
                required
                autocomplete="family-name"
            />

            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <!-- USERNAME -->
        <div>
            <x-input-label for="username" value="Nom d’utilisateur" />

            <x-text-input
                id="username"
                name="username"
                type="text"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                :value="old('username', $user->username)"
                required
                autocomplete="username"
            />

            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <!-- EMAIL -->
        <div>
            <x-input-label for="email" value="Email" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                :value="old('email', $user->email)"
                required
                autocomplete="email"
            />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">

                    <p class="text-sm text-yellow-800">
                        ⚠️ Ton adresse email n’est pas encore vérifiée.
                    </p>

                    <button
                        form="send-verification"
                        class="mt-2 underline text-sm text-yellow-700 hover:text-yellow-900"
                    >
                        Renvoyer l’email de vérification
                    </button>

                </div>

            @endif
        </div>

        <!-- PHONE -->
        <div>
            <x-input-label for="phone" value="Téléphone" />

            <x-text-input
                id="phone"
                name="phone"
                type="text"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                :value="old('phone', $user->phone)"
                autocomplete="tel"
                minlength="10"
                maxlength="15"
            />

            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <!-- SAVE -->
        <div class="flex items-center gap-4">

            <x-primary-button class="bg-green-700 hover:bg-green-800 focus:ring-green-600">
                💾 Enregistrer
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >
                    ✔ Sauvegardé
                </p>
            @endif

        </div>

    </form>

</section>