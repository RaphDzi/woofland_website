<x-app-layout>

    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

        <div class="w-full max-w-lg bg-white border border-gray-200 rounded-2xl shadow-md p-10 text-center">

            <!-- ICON / TITLE -->
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                📧 Vérification de votre e-mail
            </h2>

            <!-- MESSAGE -->
            <p class="text-sm text-gray-600 leading-relaxed mb-6">
                Merci pour votre inscription 🐾<br><br>

                Avant de commencer, veuillez vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer.<br><br>

                Si vous n’avez pas reçu l’e-mail, vous pouvez en demander un nouveau ci-dessous.
            </p>

            <!-- STATUS SUCCESS -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 text-sm text-green-700 bg-green-50 border border-green-200 p-3 rounded-lg">
                    ✔ Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                </div>
            @endif

            <!-- ACTIONS -->
            <div class="flex flex-col gap-4 items-center">

                <!-- RESEND EMAIL -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <x-primary-button class="px-6 py-3 rounded-full">
                        🔁 Renvoyer l’e-mail
                    </x-primary-button>
                </form>

                <!-- CHECK BUTTON -->
                <button
                    onclick="window.location.reload()"
                    class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition">
                    ✔ J’ai vérifié mon e-mail
                </button>

                <!-- SEPARATOR -->
                <div class="w-full border-t border-gray-200 my-2"></div>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="text-sm text-gray-500 hover:text-red-600 transition">
                        Se déconnecter
                    </button>
                </form>

            </div>

        </div>

    </div>

</x-app-layout>