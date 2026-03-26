<x-guest-layout>
    <div class="mb-6 text-sm text-gray-600 text-center leading-relaxed">
        {{ __('Merci pour votre inscription ! Avant de commencer, veuillez vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer.') }}
        <br>
        {{ __('Si vous n\'avez pas reçu l\'e-mail, vous pouvez en demander un nouveau.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-green-600 text-center bg-green-50 p-3 rounded-lg border border-green-200">
            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
        </div>
    @endif

    <!-- Actions -->
    <div class="mt-6 flex flex-col items-center gap-4">

        <!-- Bouton renvoi email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="px-6 py-2">
                {{ __('Renvoyer l\'e-mail de vérification') }}
            </x-primary-button>
        </form>

        <!-- Bouton refresh -->
        <button 
            onclick="window.location.reload()" 
            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition"
        >
            {{ __('J\'ai vérifié mon adresse e-mail') }}
        </button>

        <!-- Séparateur -->
        <div class="w-full border-t border-gray-200 my-2"></div>

        <!-- Déconnexion -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button 
                type="submit" 
                class="text-sm text-gray-500 hover:text-red-600 transition"
            >
                {{ __('Se déconnecter') }}
            </button>
        </form>

    </div>
</x-guest-layout>