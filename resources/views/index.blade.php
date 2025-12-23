@extends('layouts.app')

@section('title', 'メイン画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('content')
<header class="site-header" id="header">
    <img src="/images/studyrecord_logo.png" alt="StudyRecord" class="logo-img" width="250" height="30">
    {{-- PC用メニュー --}}
    <ul class="header-button pc-menu">
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    {{ __('ログアウトする') }}
                </button>
            </form>
        </li>
    </ul>
    {{-- スマホ時のみ表示されるハンバーガーボタン --}}
    <button class="hamburger" id="menuBtn" aria-expanded="false" aria-label="メニュー切り替え">
        ☰
    </button>
</header>
<div class="mobile-menu hidden" id="mobileMenu">
  <ul class="header-button sm-menu">
    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                {{ __('ログアウトする') }}
            </button>
        </form>
    </li>
  </ul>
</div>
<div class="body-wrapper">
    <div class="screen">
        <h1>StudyTime</h1>
        <div class="button-container">
            <button type="button" class="tile-button" onclick="location.href='/study_log';">
                <i class="fa-solid fa-pen-to-square"></i>
                勉強を記録する
            </button>
            <button type="button" class="tile-button" onclick="location.href='/calendar';">
                <i class="fa-solid fa-clock"></i>
                学習時間の表示
            </button>
            <button type="button" class="tile-button" onclick="location.href='/study_challenges/new';">
                <i class="fa-solid fa-bullseye"></i>
                目標を設定する
            </button>
            <button type="button" class="tile-button" onclick="location.href='/chat';">
                <i class="fa-solid fa-comments"></i>
                掲示板画面
            </button>
            <button type="button" class="tile-button" onclick="location.href='/settings';">
                <i class="fa-solid fa-gear"></i>
                設定
            </button>
        </div>

        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="target-label">
                <p>今月の目標時間</p>
                <input type="text" name="target_hour" value="{{ $monthlyGoal ? $monthlyGoal->target_hour : '' }}" readonly><span>時間</span>
                <input type="text" name="target_minutes" value="{{ $monthlyGoal ? $monthlyGoal->target_minutes : '' }}" readonly><span>分</span>
            </div>
        
            <div class="result">
                <p>結果</p>
                <input type="text" name="result_hour" value="{{ $resultHour }}" readonly><span>時間</span>
                <input type="text" name="result_minutes" value="{{ $resultMinutes }}" readonly><span>分</span>
            </div>

            <span class="achievement">
                {{ $achievementRate }}% 達成
            </span>

            <div class="achievement-bar">
                <canvas
                    id="monthlyProgressBar"
                    data-rate="{{ $progressRate }}">
                </canvas>
            </div>
        </div>

        <h1>学習時間</h1>
        <div class="chart-wrapper">
            <canvas id="myChart" height="400px"></canvas>
        </div>

        <script>
            const chartDates = JSON.parse(`{!! $dates !!}`);
            const chartSubjects = JSON.parse(`{!! $subjects !!}`);
            const chartData = JSON.parse(`{!! $data !!}`);
        </script>
        <script src="{{ asset('js/chart.js') }}"></script>
    </div>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
