<x-guest-layout>
    <div class="min-h-screen bg-white">
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- CARD -->
        <div class="max-w-6xl mx-auto mt-16 bg-gray-100 border border-black p-10 rounded-xl">

            <form method="POST" action="{{ route('register') }}" class="space-y-12">
                @csrf

                <!-- ================= LIGNE 1 ================= -->
                <div class="grid grid-cols-2 gap-12">

                    <!-- MAITRE -->
                    <div>
                        <h2 class="text-xl font-bold mb-6">Maître</h2>

                        <div class="space-y-4">
                            <div>
                                <x-required-input-red-star for="nom" value="Nom" required />
                                <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full"
                                    :value="old('nom')" required />
                            </div>

                            <div>
                                <x-required-input-red-star for="prenom" value="Prénom" required />
                                <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full"
                                    :value="old('prenom')" required />
                            </div>

                            <div>
                                <x-required-input-red-star for="email" value="Adresse mail" required />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    :value="old('email')" required />
                            </div>

                            <div>
                                <x-required-input-red-star for="username" value="Identifiant" required />
                                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                                    :value="old('username')" required />
                            </div>

                            <div>
                                <x-required-input-red-star for="password" value="Mot de passe" required />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                    required />
                            </div>

                            <div id="password-rules" class="mt-2 text-sm space-y-1">
                                <p id="rule-length" class="text-gray-500">❌ Au moins 8 caractères</p>
                                <p id="rule-lower" class="text-gray-500">❌ Une minuscule</p>
                                <p id="rule-upper" class="text-gray-500">❌ Une majuscule</p>
                                <p id="rule-number" class="text-gray-500">❌ Un chiffre</p>
                                <p id="rule-special" class="text-gray-500">❌ Un caractère spécial (@$!%*?&#)</p>
                            </div>

                            <div>
                                <x-required-input-red-star for="password_confirmation" value="Confirmer le mot de passe"
                                    required />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                    class="mt-1 block w-full" required />
                            </div>

                            <p id="password-match" class="text-sm mt-2 text-gray-500">
                                ❌ Les mots de passe ne correspondent pas
                            </p>
                        </div>
                    </div>

                    <!-- ADRESSE -->
                    <div>
                        <h2 class="text-xl font-bold mb-6">Adresse</h2>

                        <div class="space-y-4">
                            <div>
                                <x-required-input-red-star value="Voie" required />
                                <x-text-input name="voie" class="mt-1 block w-full" :value="old('voie')" required />
                            </div>

                            <div>
                                <x-required-input-red-star value="Code Postal" required />
                                <x-text-input name="code_postal" maxlength="5" pattern="\d{5}" class="mt-1 block w-full"
                                    :value="old('code_postal')" required />
                            </div>

                            <div>
                                <x-required-input-red-star value="Ville" required />
                                <x-text-input name="ville" class="mt-1 block w-full" :value="old('ville')" required />
                            </div>

                            <div>
                                <x-required-input-red-star value="Complément" />
                                <x-text-input name="complement" class="mt-1 block w-full" :value="old('complement')" />
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ================= LIGNE 2 ================= -->
                <div class="grid grid-cols-2 gap-12">

                    <!-- CHIEN -->
                    <div class="border p-6 rounded-lg bg-gray-50">
                        <h2 class="text-lg font-semibold mb-4">Toutou</h2>

                        <div class="space-y-4" id="chiens-wrapper">
                            <div>
                                <x-required-input-red-star value="Nom du chien" />
                                <x-text-input name="chiens[0][nom]" class="mt-1 block w-full"
                                    :value="old('chiens.0.nom')" />
                            </div>

                            <div>
                                <x-required-input-red-star value="Race" />
                                <x-text-input name="chiens[0][race]" class="mt-1 block w-full"
                                    :value="old('chiens.0.race')" />
                            </div>

                            <div>
                                <x-required-input-red-star value="Age" />
                                <x-text-input name="chiens[0][age]" type="number" min="0" max="25"
                                    class="mt-1 block w-full" :value="old('chiens.0.age')" />
                            </div>
                        </div>
                        <button type="button" id="add-chien-btn" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">
                            Ajouter un chien
                        </button>
                    </div>


                    <!-- OPTIONNEL -->
                    <div class="p-6 rounded-lg">
                        <h2 class="text-lg font-semibold mb-4">Optionnel</h2>

                        <div>
                            <x-input-label value="Comment nous avez-vous connu ?" />
                            <select name="source" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Sélectionner --</option>
                                <option value="reseaux">Réseaux sociaux</option>
                                <option value="amis">Amis</option>
                                <option value="google">Google</option>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- BOUTON -->
                <div class="flex justify-center pt-6">
                    <x-primary-button class="px-12 py-3 text-lg rounded-full">
                        Inscription
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>



    <script>
        let chienIndex = 1; // déjà un chien dans le formulaire

        document.getElementById('add-chien-btn').addEventListener('click', function () {
            const wrapper = document.getElementById('chiens-wrapper');

            const newChien = document.createElement('div');
            newChien.classList.add('chien', 'mb-4', 'border', 'p-4', 'rounded');
            newChien.innerHTML = `
    <div class="space-y-4">

        <div>
            <label class="block font-medium text-sm text-gray-700">
                Nom du chien
            </label>
            <input type="text" name="chiens[${chienIndex}][nom]"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">
                Race
            </label>
            <input type="text" name="chiens[${chienIndex}][race]"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">
                Age
            </label>
            <input type="number" name="chiens[${chienIndex}][age]"
                min="0" max="30"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <button type="button"
            class="remove-chien mt-2 px-2 py-1 bg-red-500 text-white rounded">
            Supprimer
        </button>

    </div>
`;

            wrapper.appendChild(newChien);

            // bouton supprimer
            newChien.querySelector('.remove-chien').addEventListener('click', function () {
                newChien.remove();
            });

            chienIndex++;
        });
    </script>

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