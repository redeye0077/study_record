@extends('layouts.app')

@section('title', '設定画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/settings/index.css') }}">
@endsection

@section('content')
<div class="body">
    <h1>設定</h1>
    <div class="button-container">
        <button type="button" class="btn-blue" onclick="location.href='/settings/login_id';">
            ログインIDを変更する
        </button>
        <button type="button" class="btn-blue" onclick="location.href='/settings/password';">
            パスワードを変更する
        </button>
        <button type="button" class="btn-red" onclick="location.href='/index';">
            メイン画面に戻る
        </button>
        <button type="button" class="btn-red" onclick="location.href='/settings/withdrawal';">
            退会する
        </button>
    </div>
</div>
@endsection
