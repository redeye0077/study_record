@extends('layouts.app')

@section('title', '目標時間設定画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/study_challenges_new.css') }}">
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
  <div class="container">
    <form method="POST" action="{{ route('study.challenges.new.store') }}">
      @csrf
      <div class="form-group">
        <div class="target_time">
          <p>今月の目標時間</p>
            <input type="text" name="target_hour" value=""><span>時間</span>
            <input type="text" name="target_minutes" value=""><span>分</span>
        </div>

        @error('target_hour')
          <div class="text-sm text-red-600 dark:text-red-400">
            <p class="message">{{ $message }}</p>
          </div>
        @enderror
        
        @error('target_minutes')
          <div class="text-sm text-red-600 dark:text-red-400">
            <p class="message">{{ $message }}</p>
          </div>
        @enderror
      </div>

      <div class="button-container">
        <button type="submit" class="submit-button">設定する</button>
        <button type="button" class="main-button" onclick="location.href='/index';">
          メイン画面に戻る
        </button>
      </div>
    </form>
  </div>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
