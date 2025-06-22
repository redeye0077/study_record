@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')
    <div class="detail-main-wrapper">
        <p class="channel-description">掲示板</p>
        <div class="messages-area">
            <div class="messages-wrapper">
                @foreach($messages as $msg)
                    {{-- 自分のメッセージの時の処理 --}}
                    @if ($msg->user_id == Auth::id())
                        <div class="my-message">
                            <p>{{ $msg->created_at }}<strong> {{ $msg->user->name }}</strong></p>
                            <p class="my-message_message">{{ $msg->message }}</p>
                        </div>
                    {{-- 他の人のメッセージの時の処理 --}}
                    @else
                        <div class="other-message">
                            <p>{{ $msg->created_at }}<strong> {{ $msg->user->name }}</strong></p>
                            <p class="other-message_message">{{ $msg->message }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="pagination-wrapper">
            {{-- PC表示用のページネーション --}}
            <div class="pagination-default">
                {{ $messages->links('pagination::bootstrap-4') }}
            </div>

            {{-- スマホ表示用のページネーション --}}
            <div class="pagination-simple">
                {{ $messages->links('vendor.pagination.simple') }}
            </div>
        </div>
        <form method="POST" action="{{ route('chat.store') }}">
            @csrf
            <textarea class="post-textarea" name="message" autofocus></textarea>
            <button type="submit" class="btn-blue">送信</button>
        </form>
        <button type="button" class="btn-red" onclick="location.href='/index';">
            メイン画面に戻る
        </button>
    </div>
@endsection
