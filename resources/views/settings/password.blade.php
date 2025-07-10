@extends('layouts.app')

@section('title', 'パスワード変更画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/settings/password.css') }}">
@endsection

@section('content')
<div class="body">
<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')
    @if (session('status') === 'password-updated')
    <p
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2000)"
    >{{ __('パスワードを変更しました!') }}</p>
    @endif
    <div>
        <x-input-label for="current_password" :value="__('現在のパスワード')" />
        <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password" :value="__('新しいパスワード')" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password_confirmation" :value="__('パスワードの確認')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="button-container">
        <x-primary-button>{{ __('変更する') }}</x-primary-button>
    </div>
</form>
<button type="button" class="btn-red" onclick="location.href='/settings';">
    キャンセル
</button>
</div>
@endsection
