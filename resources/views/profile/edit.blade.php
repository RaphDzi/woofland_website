<x-app-layout>

    <div class="max-w-5xl mx-auto px-6 py-12">

        <!-- HEADER -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800">
                🐶 Mon profil Woofland
            </h1>
            <p class="text-gray-500 mt-2">
                Gère tes informations personnelles et la sécurité de ton compte
            </p>
        </div>

        <!-- DOG INFO -->
        <div class="bg-white shadow-md rounded-2xl p-8 mb-8">
            @include('profile.partials.update-dog-form')
        </div>

        <!-- PROFILE INFO -->
        <div class="bg-white shadow-md rounded-2xl p-8 mb-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- ADDRESS -->
        <div class="bg-white shadow-md rounded-2xl p-8 mb-8">
            @include('profile.partials.update-address-form')
        </div>

        <!-- ADHESION -->
        <div class="bg-white shadow-md rounded-2xl p-8 mb-8">
            @include('profile.partials.adhesion')
        </div>

        <!-- PASSWORD -->
        <div class="bg-white shadow-md rounded-2xl p-8 mb-8">
            @include('profile.partials.update-password-form')
        </div>

        <!-- DELETE ACCOUNT -->
        <div class="bg-white shadow-md rounded-2xl p-8 border border-red-100">
            @include('profile.partials.delete-user-form')
        </div>

    </div>

</x-app-layout>