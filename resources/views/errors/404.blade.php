@extends('layouts.app')

@section('title', 'ページが見つかりません')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/errors/404.css') }}">
@endsection

@section('content')
    <div class="error-container">
        <h1 class="error-title">404</h1>
        <p class="error-message">ページが見つかりません。</p>
        <p class="error-subtext">お探しのページは削除されたか、URLが間違っている可能性があります。</p>
        <a href="{{ url('/index') }}" class="error-link">
            メイン画面へ戻る
        </a>
    </div>
@endsection

