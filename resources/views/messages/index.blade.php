<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-800">
                💬 Conversations
            </h1>
            <p class="text-gray-500 mt-2">
                Discutez avec les membres Woofland
            </p>
        </div>

        <!-- GRID CONVERSATIONS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($conversations as $conversation)

                @php
                    // récupérer l'autre participant
                    $otherUserId = collect($conversation->participants)
                        ->first(fn($id) => $id != auth()->id());

                    $otherUser = \App\Models\User::find($otherUserId);
                @endphp

                <a href="{{ route('messages.show', $conversation->_id) }}"
                    class="bg-white rounded-2xl shadow p-5 flex flex-col justify-between hover:shadow-lg transition">

                    <!-- INFO -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                            {{ $otherUser->username ?? 'Utilisateur inconnu' }}
                        </h2>

                        <p class="text-sm text-gray-500 mb-2">
                            🕒 {{ \Carbon\Carbon::parse($conversation->updated_at)->diffForHumans() }}
                        </p>

                        <p class="text-sm text-gray-600 mb-4 truncate">
                            💬 {{ $conversation->last_message ?? 'Aucun message' }}
                        </p>
                    </div>

                    <!-- ACTION -->
                    <div class="mt-auto">
                        <div
                            class="w-full bg-green-600 text-white text-center py-2 rounded-lg hover:bg-green-700 transition">
                            Ouvrir la conversation
                        </div>
                    </div>

                </a>

            @endforeach

        </div>

        <!-- ADMINS + FORMATEURS -->
        <div id="users" class="mt-12">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                🧑‍🏫 Admins & Formateurs
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                @foreach(\App\Models\User::where('id', '!=', auth()->id())
                    ->whereIn('role', ['admin', 'formateur'])
                    ->get() as $user)

                    <div class="bg-white shadow rounded-2xl p-4 flex justify-between items-center">

                        <div>
                            <p class="font-semibold text-gray-800">
                                {{ $user->username }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $user->email }}
                            </p>
                            <span class="text-xs text-green-600 font-semibold">
                                {{ $user->role }}
                            </span>
                        </div>

                        <form method="POST" action="{{ route('conversations.start', $user->id) }}">
                            @csrf
                            <button class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700">
                                Message
                            </button>
                        </form>

                    </div>

                @endforeach

            </div>
        </div>

        <!-- USERS NORMAUX -->
        <div class="mt-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                👥 Utilisateurs
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                @foreach(\App\Models\User::where('id', '!=', auth()->id())
                    ->whereNotIn('role', ['admin', 'formateur'])
                    ->get() as $user)

                    <div class="bg-white shadow rounded-2xl p-4 flex justify-between items-center">

                        <div>
                            <p class="font-semibold text-gray-800">
                                {{ $user->username }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $user->email }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('conversations.start', $user->id) }}">
                            @csrf
                            <button class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700">
                                Message
                            </button>
                        </form>

                    </div>

                @endforeach

            </div>
        </div>

        @if($conversations->isEmpty())
            <div class="text-center text-gray-500 mt-10">
                Aucune conversation 😢
            </div>
        @endif

    </div>
</x-app-layout>