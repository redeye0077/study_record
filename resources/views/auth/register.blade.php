@extends('layouts.app')

@section('title', '新規登録画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/resister.css') }}">
@endsection

@section('content')
<header class="site-header" id="header">
    <img src="/images/studyrecord_logo.png" alt="StudyRecord" class="logo-img" width="250" height="30">
    {{-- PC用メニュー --}}
    <ul class="header-button pc-menu">
        <li>
            <form method="POST" action="{{ route('guest.login') }}">
                @csrf
                <button type="submit" class="btn-guest">
                    ゲストログイン
                </button>
            </form>
        </li>
        <li>
            <button type="button" class="btn-login" onclick="location.href='/login';">
                ログイン
            </button>
        </li>
        <li>
            <button type="button" class="btn-login" onclick="location.href='/register';">
                新規登録
            </button> 
        </li>
    </ul>
    {{-- スマホ時のみ表示されるハンバーガーボタン --}}
    <button class="hamburger" id="menuBtn" aria-expanded="false" aria-label="メニュー切り替え">
        ☰
    </button>
</header>
{{-- スマホ用メニュー --}}
<div class="mobile-menu hidden" id="mobileMenu">
  <ul class="header-button sm-menu">
    <li>
        <form method="POST" action="{{ route('guest.login') }}">
            @csrf
            <button type="submit" class="btn-guest">
                ゲストログイン
            </button>
        </form>
    </li>
    <li>
        <button type="button" class="btn-login" onclick="location.href='/login';">
            ログイン
        </button>
    </li>
    <li>
        <button type="button" class="btn-login" onclick="location.href='/register';">
            新規登録
        </button>
    </li>
  </ul>
</div>
<div class="body">
    <div class="wrapper">
        <h1>新規登録</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name -->
            <div class="form-group">
                <x-input-label for="name" class="label" :value="__('ログインID')" />
                <x-text-input id="name" class="input" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" class="label" :value="__('メールアドレス')" />
                <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" class="label" :value="__('パスワード')" />
                <x-text-input id="password" class="input" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-input-label for="password_confirmation" class="label" :value="__('パスワード再入力')" />
                <x-text-input id="password_confirmation" class="input" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            
            <x-primary-button class="blue-button">
                {{ __('新規登録') }}
            </x-primary-button>
        </form>
        <div class="login">
            <p>アカウントをお持ちの場合</p>
            <a class="login" href="{{ route('login') }}">
                {{ __('ログイン') }}
            </a>
        </div> 
    </div>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
