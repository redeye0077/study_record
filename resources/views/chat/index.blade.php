@extends('layouts.app')

@section('title', '掲示板画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/chat/chat.css') }}">
@endsection

@section('content')
<header class="site-header" id="header">
    <img src="/images/studyrecord_logo.png" alt="StudyRecord" class="logo-img" width="250" height="30">
    {{-- PC用メニュー --}}
    <ul class="header-button pc-menu">
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    {{ __('ログアウトする') }}
                </button>
            </form>
        </li>
    </ul>
    {{-- スマホ時のみ表示されるハンバーガーボタン --}}
    <button class="hamburger" id="menuBtn" aria-expanded="false" aria-label="メニュー切り替え">
        ☰
    </button>
</header>
<div class="mobile-menu hidden" id="mobileMenu">
  <ul class="header-button sm-menu">
    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                {{ __('ログアウトする') }}
            </button>
        </form>
    </li>
  </ul>
</div>
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
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->has('message'))
        <div class="alert alert-danger">
            {{ $errors->first('message') }}
        </div>
    @endif
    <form method="POST" class="post-area" action="{{ route('chat.store') }}">
        @csrf
        <textarea class="post-textarea" name="message" autofocus></textarea>
        <button type="submit" class="submit-button">送 信</button>
    </form>
    <button type="button" class="main-button" onclick="location.href='/index';">
        メイン画面に戻る
    </button>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
