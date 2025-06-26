@extends('layouts.app')

@section('title', '学習記録画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/study_log.css') }}">
@endsection

@section('content')
<body>
  <div class="container">
    <form method="POST" action="{{ route('study.log.store') }}">
      @csrf
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <div class="study">
        <div class="form-group">
          <div class="study-date">
              <p>学習日</p>
              <input type="text" name="date" id="date" class="form-control" value="{{ old('date') }}">
          </div>
          @error('date')
            <div class="text-sm text-red-600">
              <p class="message">{{ $message }}</p>
            </div>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <div class="study-contents">
          <p>学習内容</p>
          <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}">
        </div>
          @error('subject')
            <div class="text-sm text-red-600">
              <p class="message">{{ $message }}</p>
            </div>
          @enderror
      </div>

      <div class="form-group">
        <div class="learning-date">
          <p>学習時間</p>
          <input type="number" name="hour" id="hour" class="form-control" value="{{ old('hour') }}" min="0" max="24"><span>時間</span>
          <input type="number" name="minutes" id="minutes" class="form-control" value="{{ old('minutes') }}" min="0" max="59"><span>分</span>               
        </div>

        @error('hour')
          <div class="text-sm text-red-600">
            <p class="message">{{ $message }}</p>
          </div>
        @enderror

        @error('minutes')
          <div class="text-sm text-red-600">
              <p class="message">{{ $message }}</p>
          </div>
        @enderror  
      </div>

      <div class="button-container">
        <button type="submit" class="btn-blue">
          記録する
        </button>
        <button type="button" class="btn-red" onclick="location.href='/index';">
          メイン画面に戻る
        </button>
      </div>
    </form>
  </div>
  <script>
    flatpickr("#date", {
      dateFormat: "Y/m/d",
      locale: "ja",
      clickOpens: true,
    });
  </script>
</body>
@endsection
