<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Identifiant -->
        <div>
            <x-input-label for="identifiant" value="Pseudo" />
            <x-text-input id="identifiant" type="text" name="identifiant" :value="old('identifiant')" required
                pattern="^[A-Za-z0-9_-]+$" title="Seulement lettres, chiffres, - et _" />
            <x-input-error :messages="$errors->get('identifiant')" class="mt-2" />
        </div>

        <!-- Nom -->
        <div class="mt-4">
            <x-input-label for="nom" value="Nom" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Prénom -->
        <div class="mt-4">
            <x-input-label for="prenom" value="Prénom" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')"
                required />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Adresse -->
        <div class="mt-4">
            <x-input-label for="voie" value="Voie" />
            <x-text-input id="voie" class="block mt-1 w-full" type="text" name="voie" :value="old('voie')" required />
        </div>

        <div class="mt-4">
            <x-input-label for="ville" value="Ville" />
            <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville')"
                required />
        </div>

        <div class="mt-4">
            <x-input-label for="code_postal" value="Code postal" />
            <x-text-input id="code_postal" type="text" name="code_postal" :value="old('code_postal')" required
                pattern="\d{5}" title="5 chiffres exacts" />
        </div>

        <div class="mt-6">
            <h3 class="font-bold text-lg">Vos chiens</h3>

            <div id="chiens-container">
                <div class="chien-block border p-4 mt-2 rounded relative">
                    <button type="button" onclick="supprimerChien(this)"
                        class="absolute top-2 right-2 text-red-500 font-bold">
                        ✕
                    </button>

                    <x-text-input class="block mt-1 w-full" type="text" name="chiens[0][nom]" placeholder="Nom du chien"
                        required />

                    <x-text-input class="block mt-2 w-full" type="number" name="chiens[0][age]" placeholder="Age"
                        required />

                    <x-text-input class="block mt-2 w-full" type="text" name="chiens[0][race]" placeholder="Race"
                        required />
                </div>
            </div>

            <button type="button" onclick="ajouterChien()" class="mt-3 px-3 py-1 bg-gray-200 rounded">
                + Ajouter un chien
            </button>
        </div>



        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" type="password" name="password" required
                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&#]).{8,}"
                title="Min 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial" />
        </div>
        <div id="password-rules" class="mt-2 text-sm space-y-1">
            <p id="rule-length" class="text-gray-500">• 8 caractères minimum</p>
            <p id="rule-lower" class="text-gray-500">• 1 minuscule</p>
            <p id="rule-upper" class="text-gray-500">• 1 majuscule</p>
            <p id="rule-number" class="text-gray-500">• 1 chiffre</p>
            <p id="rule-special" class="text-gray-500">• 1 caractère spécial (@$!%*?&#)</p>
        </div>


        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmation mot de passe" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required />
        </div>

        <x-input-error :messages="$errors->get('password')" class="mt-2" />


        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                S'inscrire
            </x-primary-button>
        </div>
    </form>



    <script>
        let index = 1;

        function ajouterChien() {
            const container = document.getElementById('chiens-container');

            const block = document.createElement('div');
            block.classList.add('chien-block', 'border', 'p-4', 'mt-2', 'rounded', 'relative');

            block.innerHTML = `
        <button type="button"
            onclick="supprimerChien(this)"
            class="absolute top-2 right-2 text-red-500 font-bold">
            ✕
        </button>

        <input type="text" name="chiens[${index}][nom]" placeholder="Nom du chien" class="block mt-1 w-full border-gray-300 rounded" required>
        <input type="number" name="chiens[${index}][age]" placeholder="Age" class="block mt-2 w-full border-gray-300 rounded" required>
        <input type="text" name="chiens[${index}][race]" placeholder="Race" class="block mt-2 w-full border-gray-300 rounded" required>
    `;

            container.appendChild(block);
            index++;
        }

        function supprimerChien(button) {
            const container = document.getElementById('chiens-container');
            const blocks = container.getElementsByClassName('chien-block');

            if (blocks.length <= 1) {
                alert("Vous devez avoir au moins un chien.");
                return;
            }

            button.parentElement.remove();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const password = document.getElementById('password');
            const confirmation = document.getElementById('password_confirmation');
            const form = document.querySelector('form');
            const matchMessage = document.getElementById('password-match-message');

            const rules = {
                length: document.getElementById('rule-length'),
                lower: document.getElementById('rule-lower'),
                upper: document.getElementById('rule-upper'),
                number: document.getElementById('rule-number'),
                special: document.getElementById('rule-special'),
            };

            function updateRule(element, isValid) {
                if (isValid) {
                    element.style.color = "green";
                } else {
                    element.style.color = "#6B7280";
                }
            }

            function validatePassword() {
                const value = password.value;

                const hasLength = value.length >= 8;
                const hasLower = /[a-z]/.test(value);
                const hasUpper = /[A-Z]/.test(value);
                const hasNumber = /[0-9]/.test(value);
                const hasSpecial = /[@$!%*?&#]/.test(value);

                updateRule(rules.length, hasLength);
                updateRule(rules.lower, hasLower);
                updateRule(rules.upper, hasUpper);
                updateRule(rules.number, hasNumber);
                updateRule(rules.special, hasSpecial);

                return hasLength && hasLower && hasUpper && hasNumber && hasSpecial;
            }

            function validateConfirmationLive() {

                if (confirmation.value === "") {
                    matchMessage.textContent = "";
                    return false;
                }

                if (password.value === confirmation.value) {
                    matchMessage.textContent = "✔ Les mots de passe correspondent";
                    matchMessage.style.color = "green";
                    return true;
                } else {
                    matchMessage.textContent = "✖ Les mots de passe ne correspondent pas";
                    matchMessage.style.color = "red";
                    return false;
                }
            }

            password.addEventListener('input', function () {
                validatePassword();
                validateConfirmationLive();
            });

            confirmation.addEventListener('input', validateConfirmationLive);

            form.addEventListener('submit', function (e) {

                const isPasswordValid = validatePassword();
                const isConfirmationValid = validateConfirmationLive();

                if (!isPasswordValid) {
                    e.preventDefault();
                    alert("Le mot de passe ne respecte pas les critères.");
                    return;
                }

                if (!isConfirmationValid) {
                    e.preventDefault();
                    alert("Les mots de passe ne correspondent pas.");
                }
            });

        });
    </script>

    <script>
        const password = document.getElementById('password');
        const confirmation = document.getElementById('password_confirmation');

        const message = document.createElement('p');
        message.classList.add('mt-2', 'text-sm');
        confirmation.parentNode.appendChild(message);

        function verifierMotDePasse() {
            if (confirmation.value === '') {
                message.textContent = '';
                return;
            }

            if (password.value === confirmation.value) {
                message.textContent = "✔ Les mots de passe correspondent";
                message.style.color = "green";
            } else {
                message.textContent = "✖ Les mots de passe ne correspondent pas";
                message.style.color = "red";
            }
        }

        password.addEventListener('input', verifierMotDePasse);
        confirmation.addEventListener('input', verifierMotDePasse);

        // Bloquer le submit si ça ne correspond pas
        document.querySelector('form').addEventListener('submit', function (e) {
            if (password.value !== confirmation.value) {
                e.preventDefault();
                alert("Les mots de passe ne correspondent pas !");
            }
        });
    </script>


</x-guest-layout>