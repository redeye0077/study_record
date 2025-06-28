@extends('layouts.app')

@section('title', '退会画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/settings/withdrawal.css') }}">
@endsection

@section('content')
<div class="body">
  @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
  @endif
    <h1>「退会する」のボタンを押すと</h1>
    <h1>退会が完了いたします。</h1>
    <h1>本当に退会してもよろしいですか？</h1>

    <div class="button-container">
        <form action="{{ route('settings.withdrawal.post') }}" method="post">
          @csrf
          @method('POST')
          <button type="submit" class="btn-red">退会する</button>
        </form>
      
        <button type="button" class="btn-blue" onclick="location.href='/settings';">
          キャンセル
        </button>
      </div>      
</div>
@endsection
