@extends('layouts.app')

@section('title', 'メール認証画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">
@endsection

@section('content')
    <div class="verify-email-wrapper">
        <div class="verify-email-card">
            <h1 class="verify-email-title">メールアドレスの確認</h1>

            <p class="verify-email-text">
                ご登録ありがとうございます。<br>
                ご入力いただいたメールアドレス宛に確認用メールを送信しました。<br>
                メール内のリンクをクリックして認証を完了してください。
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="verify-email-status">
                    新しい確認リンクをメールアドレスに送信しました。
                </div>
            @endif

            <div class="verify-email-actions">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="verify-email-resend">
                        メールを再送信する
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="verify-email-logout">
                        ログアウト
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
