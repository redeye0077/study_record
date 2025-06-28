@extends('layouts.app')

@section('title', '目標時間設定画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/study_challenges_new.css') }}">
@endsection

@section('content')
<div class="body">
  <div class="container">
    <form method="POST" action="{{ route('study.challenges.new.store') }}">
      @csrf
      <div class="form-group">
        <div class="target_time">
          <p>今月の目標時間</p>
            <input type="text" name="target_hour" value=""><span>時間</span>
            <input type="text" name="target_minutes" value=""><span>分</span>
        </div>

        @error('target_hour')
          <div class="text-sm text-red-600">
            <p class="message">{{ $message }}</p>
          </div>
        @enderror
        
        @error('target_minutes')
          <div class="text-sm text-red-600">
            <p class="message">{{ $message }}</p>
          </div>
        @enderror
      </div>

      <div class="button-container">
        <button type="submit" class="btn-blue">設定する</button>
        <button type="button" class="btn-red" onclick="location.href='/index';">
          キャンセル
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
