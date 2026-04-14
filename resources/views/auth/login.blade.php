<x-app-layout>

    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

        <!-- CARD -->
        <div class="w-full max-w-lg bg-white border border-gray-200 rounded-2xl shadow-md p-10">

            <!-- STATUS -->
            <x-auth-session-status class="mb-4 text-center text-green-600 font-medium" :status="session('status')" />

            <!-- TITLE -->
            <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">
                🐾 Connexion Woofland
            </h2>

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- EMAIL -->
                <div>
                    <x-input-label for="email" :value="__('Adresse email')" />

                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        type="email" name="email" :value="old('email')" required autofocus />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- PASSWORD -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" />

                    <x-text-input id="password"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        type="password" name="password" required />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- OPTIONS -->
                <div class="flex items-center justify-between text-sm">
                    @if (Route::has('password.request'))
                        <a class="text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <!-- BUTTON -->
                <div class="pt-4">
                    <x-primary-button class="w-full justify-center py-3 rounded-full text-lg">
                        Se connecter
                    </x-primary-button>
                </div>

                <!-- REGISTER -->
                <div class="text-center text-sm text-gray-600">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                        S’inscrire
                    </a>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>