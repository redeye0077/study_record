@extends('layouts.app')

@section('title', 'ログイン画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
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
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif    

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1>ログイン</h1>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-form">
            <!-- Name -->
            <div>
                <x-input-label for="name" class="label" :value="__('ログインID')" />
                <x-text-input id="name" class="input" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" class="label" :value="__('パスワード')" />
    
                <x-text-input id="password" class="input"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>
    
        <div class="button-container">
            <x-primary-button class="blue-button">
                {{ __('ログイン') }}
            </x-primary-button>
        </div>    
    </form>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
