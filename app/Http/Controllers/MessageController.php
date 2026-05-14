<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $conversations = Conversation::where('participants', 'all', [auth()->id()])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('messages.index', compact('conversations'));
    }

    public function show($id)
    {
        $messages = Message::where('conversation_id', $id)
            ->orderBy('created_at')
            ->get();

        return view('messages.show', compact('messages', 'id'));
    }

    public function store(Request $request)
    {
        Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => auth()->id(),
            'content' => $request->input('content')
        ]);

        Conversation::where('_id', $request->conversation_id)
            ->update([
                'last_message' => $request->input('content'),
                'updated_at' => now()
            ]);

        return back();
    }

    public function start($userId)
    {
        $authId = auth()->id();

        // vérifier si conversation existe déjà
        $conversation = Conversation::where('participants', 'all', [$authId, $userId])
            ->first();

        // si elle existe déjà → retour direct
        if ($conversation) {
            return redirect()->route('messages.show', $conversation->_id);
        }

        // sinon créer conversation
        $conversation = Conversation::create([
            'participants' => [$authId, $userId],
            'last_message' => null,
            'updated_at' => now()
        ]);

        return redirect()->route('messages.show', $conversation->_id);
    }
}
