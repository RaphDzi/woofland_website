<x-guest-layout>
    <div class="min-h-screen bg-white flex items-center justify-center">

        <!-- CARD -->
        <div class="w-full max-w-xl bg-gray-100 border border-black p-10 rounded-xl shadow-sm">

            <!-- Status -->
            <x-auth-session-status class="mb-6 text-center text-green-600 font-medium" :status="session('status')" />

            <h2 class="text-2xl font-bold text-center mb-8">
                Connexion
            </h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- EMAIL -->
                <div>
                    <x-input-label for="email" :value="__('Adresse email')" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- PASSWORD -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required 
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- OPTIONS -->
                <div class="flex items-center justify-between text-sm">
                    
                    <!-- Remember -->
                    <label class="flex items-center gap-2 text-gray-600">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                            name="remember"
                        >
                        Se souvenir de moi
                    </label>

                    <!-- Forgot -->
                    @if (Route::has('password.request'))
                        <a 
                            class="text-indigo-600 hover:text-indigo-800 font-medium transition" 
                            href="{{ route('password.request') }}"
                        >
                            Mot de passe oublié ?
                        </a>
                    @endif

                </div>

                <!-- BOUTON -->
                <div class="pt-4">
                    <x-primary-button class="w-full justify-center py-3 text-lg rounded-full">
                        Se connecter
                    </x-primary-button>
                </div>

                <!-- REGISTER LINK -->
                <div class="text-center text-sm text-gray-600">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                        S’inscrire
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>