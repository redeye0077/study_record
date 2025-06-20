@extends('layouts.app')

@section('content')
<div class="container">
    <h1>チャットルーム</h1>

    <div class="chat-box" style="max-height: 400px; overflow-y: scroll; border: 1px solid; padding: 10px;">
        @foreach($messages as $msg)
            @if ($msg->user_id == Auth::id())
                <div style="text-align: right;"><strong>{{ $msg->user->name }}:</strong> {{ $msg->message }}</div>
            @else
                <div style="text-align: left;"><strong>{{ $msg->user->name }}:</strong> {{ $msg->message }}</div>
            @endif
        @endforeach
    </div>
    <div class="mt-3">
        {{ $messages->links() }}
    </div>
    <a href="/index" class="btn_return_index">メイン画面に戻る</a>
</div>
@endsection
