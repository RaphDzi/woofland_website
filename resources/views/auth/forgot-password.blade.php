<x-guest-layout>

    <!-- TITRE / EXPLICATION -->
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-green-800 mb-3">
            Mot de passe oublié ?
        </h2>

        <p class="text-sm text-gray-600 leading-relaxed">
            {{ __("Pas de souci 🐶 Indiquez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.") }}
            <br>
            {{ __("Vous pourrez ensuite choisir un nouveau mot de passe.") }}
        </p>
    </div>

    <!-- STATUS -->
    @if (session('status'))
        <div class="mb-6 text-sm text-green-700 bg-green-50 border border-green-200 p-3 rounded-xl text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- FORM -->
    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- EMAIL -->
        <div>
            <x-input-label for="email" :value="__('Adresse e-mail')" />

            <x-text-input
                id="email"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                placeholder="exemple@mail.com"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- BUTTON -->
        <div class="flex justify-center">
            <x-primary-button class="bg-green-700 hover:bg-green-800 px-6 py-2 rounded-lg shadow">
                {{ __("Envoyer le lien de réinitialisation") }}
            </x-primary-button>
        </div>

    </form>

</x-a-layout>