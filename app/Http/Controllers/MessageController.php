<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $conversations = Conversation::where('participants', 'all', [$this->authenticatedUserId()])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('messages.index', compact('conversations'));
    }

    public function show(string $id): View
    {
        $messages = Message::where('conversation_id', $id)
            ->orderBy('created_at')
            ->get();

        return view('messages.show', compact('messages', 'id'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'conversation_id' => ['required', 'string'],
            'content' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'conversation_id' => $validated['conversation_id'],
            'sender_id' => $this->authenticatedUserId(),
            'content' => $validated['content'],
        ]);

        Conversation::where('_id', $validated['conversation_id'])
            ->update([
                'last_message' => $validated['content'],
                'updated_at' => now(),
            ]);

        return back();
    }

    public function start(int $userId): RedirectResponse
    {
        $authId = $this->authenticatedUserId();

        $conversation = Conversation::where('participants', 'all', [$authId, $userId])
            ->first();

        if ($conversation) {
            return redirect()->route('messages.show', (string) $conversation->getKey());
        }

        $conversation = Conversation::create([
            'participants' => [$authId, $userId],
            'last_message' => null,
            'updated_at' => now(),
        ]);

        return redirect()->route('messages.show', (string) $conversation->getKey());
    }

    private function authenticatedUserId(): int|string
    {
        $id = Auth::id();

        if ($id === null) {
            abort(403);
        }

        return $id;
    }
}
