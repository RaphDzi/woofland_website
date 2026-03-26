<x-guest-layout>
    <div class="mb-6 text-sm text-gray-600 text-center leading-relaxed">
        {{ __('Mot de passe oublié ? Pas de souci. Indiquez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.') }}
        <br>
        {{ __('Vous pourrez ensuite choisir un nouveau mot de passe.') }}
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 font-medium text-sm text-green-600 text-center bg-green-50 p-3 rounded-lg border border-green-200">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="mt-6 flex flex-col items-center gap-4">
        @csrf

        <!-- EMAIL -->
        <div class="w-full max-w-md">
            <x-input-label for="email" :value="__('Adresse e-mail')" />
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

        <!-- BUTTON -->
        <div class="w-full flex justify-center pt-2">
            <x-primary-button class="px-6 py-2">
                {{ __('Envoyer le lien de réinitialisation') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>