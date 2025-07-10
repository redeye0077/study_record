@extends('layouts.app')

@section('title', 'ログイン画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
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
                <x-input-label for="name" :value="__('ログインID')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('パスワード')" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>
    
        <div class="button-container">
            <x-primary-button class="ml-3">
                {{ __('ログイン') }}
            </x-primary-button>
    
            <button type="button" class="btn-black" onclick="location.href='/register';">
                新規登録
            </button>
        </div>    
    </form>
</div>
@endsection
