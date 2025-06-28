@extends('layouts.app')

@section('title', 'サポートされていないバージョン')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/errors/500.css') }}">
@endsection

@section('content')
    <div class="error-container">
        <h1 class="error-title">500</h1>
        <p class="error-message">サポートされていないHTTPバージョンです。</p>
        <p class="error-subtext">お使いのブラウザまたはクライアントが、このリクエストを処理できない可能性があります。</p>
        <a href="{{ url('/index') }}" class="error-link">
            メイン画面へ戻る
        </a>
    </div>
@endsection
