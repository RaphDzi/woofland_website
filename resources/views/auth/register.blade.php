<x-app-layout>

    <div class="min-h-screen bg-gray-50 py-10 px-4">

        <!-- CARD PRINCIPALE -->
        <div class="max-w-6xl mx-auto bg-white border border-gray-200 shadow-md rounded-2xl p-10">

            <!-- TITLE -->
            <h2 class="text-3xl font-bold text-center mb-10 text-gray-800">
                🐾 Inscription Woofland
            </h2>

            <!-- ERREURS GLOBALES -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-12">
                @csrf

                <!-- ================= TOP GRID ================= -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    <!-- 👤 MAÎTRE -->
                    <div class="bg-gray-50 p-6 rounded-xl border">

                        <h3 class="text-xl font-bold mb-6">👤 Maître</h3>

                        <div class="space-y-4">

                            <x-required-input-red-star for="firstname" value="Prénom" />
                            <x-text-input name="firstname" class="w-full" :value="old('firstname')" />

                            <x-required-input-red-star for="lastname" value="Nom" />
                            <x-text-input name="lastname" class="w-full" :value="old('lastname')" />

                            <x-required-input-red-star for="email" value="Email" />
                            <x-text-input type="email" name="email" class="w-full" :value="old('email')" />

                            <x-required-input-red-star for="username" value="Identifiant" />
                            <x-text-input name="username" class="w-full" :value="old('username')" />

                            <x-required-input-red-star for="phone" value="Téléphone" />
                            <x-text-input name="phone" class="w-full" :value="old('phone')" />

                            <x-required-input-red-star for="password" value="Mot de passe" />
                            <x-text-input id="password" type="password" name="password" class="w-full" />

                            <x-required-input-red-star for="password_confirmation" value="Confirmation" />
                            <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                                class="w-full" />

                            <!-- RULES -->
                            <div id="password-rules" class="text-sm space-y-1 mt-3">
                                <p id="rule-length">❌ 8 caractères</p>
                                <p id="rule-lower">❌ minuscule</p>
                                <p id="rule-upper">❌ majuscule</p>
                                <p id="rule-number">❌ chiffre</p>
                                <p id="rule-special">❌ caractère spécial</p>
                            </div>

                            <p id="password-match" class="text-sm text-gray-500 mt-2">
                                ❌ Les mots de passe ne correspondent pas
                            </p>

                        </div>
                    </div>

                    <!-- 🏠 ADRESSE -->
                    <div class="bg-gray-50 p-6 rounded-xl border">

                        <h3 class="text-xl font-bold mb-6">🏠 Adresse</h3>

                        <div class="space-y-4">

                            <x-required-input-red-star value="Voie" />
                            <x-text-input name="voie" class="w-full" :value="old('voie')" />

                            <x-required-input-red-star value="Code postal" />
                            <x-text-input name="code_postal" maxlength="5" class="w-full" :value="old('code_postal')" />

                            <x-required-input-red-star value="Ville" />
                            <x-text-input name="ville" class="w-full" :value="old('ville')" />

                            <x-input-label value="Complément" />
                            <x-text-input name="complement" class="w-full" :value="old('complement')" />

                        </div>
                    </div>

                </div>

                <!-- ================= CHIENS ================= -->
                <div class="bg-white border rounded-xl p-6">

                    <h3 class="text-xl font-bold mb-6">🐶 Chiens</h3>

                    <div id="chiens-wrapper" class="space-y-4">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <x-text-input name="chiens[0][nom]" placeholder="Nom" :value="old('chiens[0][nom]')" />
                            <x-text-input name="chiens[0][race]" placeholder="Race" :value="old('chiens[0][race]')" />
                            <x-text-input type="number" name="chiens[0][age]" placeholder="Âge" :value="old('chiens[0][age]')" />
                        </div>

                    </div>

                    <button type="button" id="add-chien-btn"
                        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        + Ajouter un chien
                    </button>

                </div>

                <!-- ================= SUBMIT ================= -->
                <div class="text-center">
                    <x-primary-button class="px-10 py-3 text-lg rounded-full">
                        S'inscrire
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
<script>
    let chienIndex = 1;

    // =========================
    // AJOUT CHIENS
    // =========================
    document.getElementById('add-chien-btn').addEventListener('click', function () {

        const wrapper = document.getElementById('chiens-wrapper');

        const div = document.createElement('div');

        div.classList.add('grid', 'grid-cols-1', 'md:grid-cols-3', 'gap-4');

        div.innerHTML = `
            <input type="text" name="chiens[${chienIndex}][nom]" placeholder="Nom"
                class="border rounded p-2 w-full">

            <input type="text" name="chiens[${chienIndex}][race]" placeholder="Race"
                class="border rounded p-2 w-full">

            <input type="number" name="chiens[${chienIndex}][age]" placeholder="Âge"
                class="border rounded p-2 w-full">

            <button type="button"
                class="remove bg-red-500 text-white rounded px-2 py-1">
                Supprimer
            </button>
        `;

        wrapper.appendChild(div);

        div.querySelector('.remove').addEventListener('click', () => {
            div.remove();
        });

        chienIndex++;
    });

    // =========================
    // PASSWORD CHECK MATCH
    // =========================
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    const matchText = document.getElementById('password-match');

    function checkMatch() {
        if (!password || !confirmPassword) return;

        if (confirmPassword.value === "") {
            matchText.textContent = "❌ Les mots de passe ne correspondent pas";
            matchText.classList.remove('text-green-600');
            matchText.classList.add('text-gray-500');
            return;
        }

        if (password.value === confirmPassword.value) {
            matchText.textContent = "✅ Correspondance OK";
            matchText.classList.add('text-green-600');
            matchText.classList.remove('text-gray-500');
        } else {
            matchText.textContent = "❌ Ne correspond pas";
            matchText.classList.remove('text-green-600');
            matchText.classList.add('text-gray-500');
        }
    }

    // =========================
    // PASSWORD RULES
    // =========================
    const rules = {
        length: document.getElementById('rule-length'),
        lower: document.getElementById('rule-lower'),
        upper: document.getElementById('rule-upper'),
        number: document.getElementById('rule-number'),
        special: document.getElementById('rule-special'),
    };

    function updateRule(element, valid) {
        if (!element) return;

        const isChecked = element.textContent.includes('✅');

        if (valid && !isChecked) {
            element.textContent = element.textContent.replace('❌', '✅');
            element.classList.remove('text-gray-500');
            element.classList.add('text-green-600');
        }

        if (!valid && isChecked) {
            element.textContent = element.textContent.replace('✅', '❌');
            element.classList.remove('text-green-600');
            element.classList.add('text-gray-500');
        }
    }

    function validatePassword() {
        if (!password) return;

        const value = password.value;

        updateRule(rules.length, value.length >= 8);
        updateRule(rules.lower, /[a-z]/.test(value));
        updateRule(rules.upper, /[A-Z]/.test(value));
        updateRule(rules.number, /[0-9]/.test(value));
        updateRule(rules.special, /[@$!%*?&#]/.test(value));
    }

    // =========================
    // EVENTS
    // =========================
    password.addEventListener('input', () => {
        validatePassword();
        checkMatch();
    });

    confirmPassword.addEventListener('input', checkMatch);
</script>

</x-app-layout>