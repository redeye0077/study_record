@extends('layouts.app')

@section('title', 'ログインID変更画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/settings/login_id.css') }}">
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
<div class="body">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('settings.login.id.update') }}" style="text-align:center;">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">新しいログインID</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->name }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <div class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        <p class="message">{{ $message }}</p>
                    </div>
                </span>
            @enderror
        </div>
        <div class="button-container">
            <button type="submit" class="submit-button">
                変更する
            </button>
            <button type="button" class="setting-button" onclick="location.href='/settings';">
                設定画面に戻る
            </button>
        </div>
    </form>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
