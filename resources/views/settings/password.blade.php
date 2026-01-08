@extends('layouts.app')

@section('title', 'パスワード変更画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/settings/password.css') }}">
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
<form method="post" action="{{ route('password.update') }}" class="settings-section">
    @csrf
    @method('put')
    @if (session('status') === 'password-updated')
    <p
        x-data="{ show: true }"
        x-show="show"
    >{{ __('パスワードを変更しました!') }}</p>
    @endif
    <div>
        <x-input-label for="current_password" class="label" :value="__('現在のパスワード')" />
        <x-text-input id="current_password" class="input" name="current_password" type="password" autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password" class="label" :value="__('新しいパスワード')" />
        <x-text-input id="password" class="input" name="password" type="password" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password_confirmation" class="label" :value="__('パスワードの確認')" />
        <x-text-input id="password_confirmation" class="input" name="password_confirmation" type="password" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="button-container">
        <x-primary-button class="submit-button">{{ __('変更する') }}</x-primary-button>
    </div>
</form>
<button type="button" class="setting-button" onclick="location.href='/settings';">
    設定画面に戻る
</button>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
