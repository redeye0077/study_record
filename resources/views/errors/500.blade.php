@extends('layouts.app')

@section('title', 'システムエラー')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[70vh] text-center px-4">
        <h1 class="text-6xl font-bold text-red-600 mb-4">500</h1>
        <p class="text-xl text-gray-700 mb-2">内部サーバーエラーが発生しました。</p>
        <p class="text-gray-500 mb-6">申し訳ありません。時間をおいて再度お試しください。</p>
        <a href="{{ url('/') }}" class="text-blue-600 underline hover:text-blue-800 transition">
            トップページへ戻る
        </a>
    </div>
@endsection
