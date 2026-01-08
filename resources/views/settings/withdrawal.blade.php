@extends('layouts.app')

@section('title', '退会画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/settings/withdrawal.css') }}">
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
  @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
  @endif
    <h1>「退会する」のボタンを押すと</h1>
    <h1>退会が完了いたします。</h1>
    <h1>本当に退会してもよろしいですか？</h1>

    <div class="button-container">
        <form action="{{ route('settings.withdrawal.post') }}" method="post">
          @csrf
          @method('POST')
          <button type="submit" class="withdrawal-button">退会する</button>
        </form>
      
        <button type="button" class="setting-button" onclick="location.href='/settings';">
          設定画面に戻る
        </button>
      </div>      
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
