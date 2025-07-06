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
        $messagesNumber = 10;
        $messages = Message::with('user')->orderBy('created_at', 'asc')->paginate($messagesNumber);
        return view('chat.index', compact('messages'));
    }

    public function store(StoreMessageRequest $request)
    {
        Message::create([
            'user_id' => Auth::id(),
            // 現在はチャットルームが1つのため、id=1で固定してます。
            'chat_room_id' => 1,
            'message' => $request->message,
        ]);

        return redirect()->route('chat.index')->with('success', 'メッセージが投稿されました！');
    }
}

