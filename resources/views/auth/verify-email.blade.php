@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center max-w-lg w-full px-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">メールアドレスの確認</h1>

            <p class="text-gray-600 leading-relaxed mb-6">
                ご登録ありがとうございます。<br>
                ご入力いただいたメールアドレス宛に確認用メールを送信しました。<br>
                メール内のリンクをクリックして認証を完了してください。
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 font-medium text-green-600">
                    新しい確認リンクをメールアドレスに送信しました。
                </div>
            @endif

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button>
                        メールを再送信する
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                        ログアウト
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
