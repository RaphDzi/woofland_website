<x-guest-layout>
    <div class="mb-6 text-sm text-gray-600 text-center">
        {{ __('Entrez le code reçu par SMS pour continuer.') }}
    </div>

    <form method="POST" action="{{ route('2fa.verify') }}" class="flex flex-col items-center gap-4">
        @csrf

        <input 
            type="text" 
            name="code" 
            placeholder="Code SMS"
            class="border-gray-300 rounded-md shadow-sm w-full text-center text-lg tracking-widest"
            required
        >

        @error('code')
            <div class="text-red-600 text-sm">
                {{ $message }}
            </div>
        @enderror

        <x-primary-button>
            Vérifier
        </x-primary-button>
    </form>
</x-guest-layout>