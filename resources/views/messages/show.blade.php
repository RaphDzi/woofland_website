<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="mb-6">
            <a href="{{ route('messages.index') }}"
               class="text-green-600 hover:underline text-sm">
                ← Retour aux conversations
            </a>
        </div>

        <!-- MESSAGES BOX -->
        <div id="chat-box"
             class="bg-white shadow rounded-2xl p-5 h-[500px] overflow-y-auto flex flex-col space-y-3">

            @foreach($messages as $message)

                @php
                    $isMe = $message->sender_id == auth()->id();
                @endphp

                <div class="flex mt-1 {{ $isMe ? 'justify-end' : 'justify-start' }}">

                    <div class="{{ $isMe ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800' }}
                                 px-3 py-1 rounded-2xl max-w-xs">

                        <p class="text-sm">
                            {{ $message->content }}
                        </p>

                        <p class="text-xs mt-1 opacity-70">
                            {{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

        <!-- INPUT MESSAGE -->
        <form method="POST"
              action="{{ route('messages.store') }}"
              class="mt-4 flex gap-2">

            @csrf

            <input type="hidden" name="conversation_id" value="{{ request()->route('id') }}">

            <input type="text"
                   name="content"
                   placeholder="Écris ton message..."
                   class="w-full border rounded-lg px-4 py-2">

            <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                Envoyer
            </button>

        </form>

    </div>

    <!-- AUTO SCROLL -->
    <script>
        const box = document.getElementById('chat-box');
        box.scrollTop = box.scrollHeight;
    </script>

</x-app-layout>