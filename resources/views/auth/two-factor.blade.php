<x-guest-layout>

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-green-800 mb-2">
            Vérification 2FA 🐶
        </h2>

        <p class="text-sm text-gray-600">
            Entre le code reçu par email pour continuer.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-4 text-red-600 text-sm text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('2fa.verify') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Code
            </label>
            <input required placeholder="123456" type="text" name="code" autocomplete="one-time-code" inputmode="numeric" pattern="[0-9]*" class="mt-1 w-full border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" value="1">
            <label for="remember" class="text-sm text-gray-600">
                Se souvenir de cet appareil (2 mois)
            </label>
        </div>

        <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg">
            Valider
        </button>

    </form>

</x-guest-layout>