@extends('layouts.app')

@section('title', '新規登録画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/resister.css') }}">
@endsection

@section('content')
<div class="body">
    <div class="wrapper">
        <h1>新規登録</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name -->
            <div class="form-group">
                <x-input-label for="name" :value="__('ログインID')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('メールアドレス')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('パスワード')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('パスワード再入力')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="new">
                <x-primary-button class="blue-button">
                    {{ __('新規登録') }}
                </x-primary-button>
            </div>
        </form>
        <div class="login">
            <p>アカウントをお持ちの場合</p>
            <a class="login" href="{{ route('login') }}">
                {{ __('ログイン') }}
            </a>
        </div> 
    </div>
</div>
@endsection
