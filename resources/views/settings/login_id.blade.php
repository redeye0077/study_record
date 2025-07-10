@extends('layouts.app')

@section('title', 'ログインID変更画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/settings/login_id.css') }}">
@endsection

@section('content')
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
            <button type="submit" class="btn-blue">
                変更する
            </button>
            <button type="button" class="btn-red" onclick="location.href='/settings';">
                キャンセル
            </button>
        </div>
    </form>
</div>
@endsection
