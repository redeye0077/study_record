<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // 1ページの表示件数
        $messagesNumber = config('chat.pagination.per_page');
        $messages = Message::with('user')->orderBy('created_at', 'asc')->paginate($messagesNumber);
        return view('chat.index', compact('messages'));
    }

    public function store(StoreMessageRequest $request)
    {
        $chatRoomId = config('chat.room.id');
        Message::create([
            'user_id' => Auth::id(),
            'chat_room_id' => $chatRoomId,
            'message' => $request->message,
        ]);

        return redirect()->route('chat.index')->with('success', 'メッセージが投稿されました！');
    }
}

