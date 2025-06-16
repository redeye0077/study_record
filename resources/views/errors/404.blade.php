@extends('layouts.app')

@section('title', 'ページが見つかりません')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[70vh] text-center px-4">
        <h1 class="text-6xl font-bold text-red-500 mb-4">404</h1>
        <p class="text-xl text-gray-700 mb-2">ページが見つかりません。</p>
        <p class="text-gray-500 mb-6">お探しのページは削除されたか、URLが間違っている可能性があります。</p>
        <a href="{{ url('/') }}" class="text-blue-600 underline hover:text-blue-800 transition">
            トップページへ戻る
        </a>
    </div>
@endsection
