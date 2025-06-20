<?php
namespace App\Http\Controllers;

use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->orderBy('created_at', 'asc')->paginate(10);
        return view('chat.index', compact('messages'));
    }
}

