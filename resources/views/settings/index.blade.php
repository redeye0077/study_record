@extends('layouts.app')

@section('title', '設定画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/settings/index.css') }}">
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
    <h1>設定</h1>
    <div class="button-container">
        <button type="button" class="btn-main" onclick="location.href='/settings/login_id';">
            ログインIDを変更する
        </button>
        <button type="button" class="btn-main" onclick="location.href='/settings/password';">
            パスワードを変更する
        </button>
        <button type="button" class="btn-main" onclick="location.href='/index';">
            メイン画面に戻る
        </button>
        <button type="button" class="btn-main" onclick="location.href='/settings/withdrawal';">
            退会する
        </button>
    </div>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
