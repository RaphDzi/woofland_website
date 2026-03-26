<x-guest-layout>
    <div class="mb-6 text-sm text-gray-600 text-center leading-relaxed">
        {{ __('Choisissez un nouveau mot de passe sécurisé pour votre compte.') }}
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="mt-6 flex flex-col items-center gap-5">
        @csrf

        <!-- TOKEN -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- EMAIL -->
        <div class="w-full max-w-md">
            <x-input-label for="email" :value="__('Adresse e-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- PASSWORD -->
        <div class="w-full max-w-md">
            <x-input-label for="password" :value="__('Nouveau mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div id="password-rules" class="mt-2 text-sm space-y-1">
            <p id="rule-length" class="text-gray-500">❌ Au moins 8 caractères</p>
            <p id="rule-lower" class="text-gray-500">❌ Une minuscule</p>
            <p id="rule-upper" class="text-gray-500">❌ Une majuscule</p>
            <p id="rule-number" class="text-gray-500">❌ Un chiffre</p>
            <p id="rule-special" class="text-gray-500">❌ Un caractère spécial (@$!%*?&#)</p>
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="w-full  max-w-md">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <p id="password-match" class="text-sm mt-2 text-gray-500">
            ❌ Les mots de passe ne correspondent pas
        </p>

        <!-- BUTTON -->
        <div class="w-full flex justify-center pt-2">
            <x-primary-button class="px-6 py-2">
                {{ __('Réinitialiser le mot de passe') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');

        const rules = {
            length: document.getElementById('rule-length'),
            lower: document.getElementById('rule-lower'),
            upper: document.getElementById('rule-upper'),
            number: document.getElementById('rule-number'),
            special: document.getElementById('rule-special'),
        };

        const matchText = document.getElementById('password-match');

        function updateRule(element, condition) {
            if (condition) {
                element.textContent = element.textContent.replace('❌', '✅');
                element.classList.remove('text-gray-500');
                element.classList.add('text-green-600');
            } else {
                element.textContent = element.textContent.replace('✅', '❌');
                element.classList.remove('text-green-600');
                element.classList.add('text-gray-500');
            }
        }

        function validatePassword() {
            const value = password.value;

            updateRule(rules.length, value.length >= 8);
            updateRule(rules.lower, /[a-z]/.test(value));
            updateRule(rules.upper, /[A-Z]/.test(value));
            updateRule(rules.number, /[0-9]/.test(value));
            updateRule(rules.special, /[@$!%*?&#]/.test(value));
        }

        function checkMatch() {
            if (confirmPassword.value === "") {
                matchText.textContent = "❌ Les mots de passe ne correspondent pas";
                matchText.classList.remove('text-green-600');
                matchText.classList.add('text-gray-500');
                return;
            }

            if (password.value === confirmPassword.value) {
                matchText.textContent = "✅ Les mots de passe correspondent";
                matchText.classList.remove('text-gray-500');
                matchText.classList.add('text-green-600');
            } else {
                matchText.textContent = "❌ Les mots de passe ne correspondent pas";
                matchText.classList.remove('text-green-600');
                matchText.classList.add('text-gray-500');
            }
        }

        password.addEventListener('input', () => {
            validatePassword();
            checkMatch();
        });

        confirmPassword.addEventListener('input', checkMatch);
    </script>
</x-guest-layout>