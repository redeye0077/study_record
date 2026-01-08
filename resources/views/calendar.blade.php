@extends('layouts.app')

@section('title', 'メイン画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
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
<div class="chart-wrapper">
    <h1>学習時間</h1>
    
    <div style="width: 80%; height: 500px">
        <canvas id="myChart"></canvas>
    </div>

    <button type="button" class="main-button" onclick="location.href='/index';">
        メイン画面に戻る
    </button>

    <script>
        const chartDates = JSON.parse(`{!! $dates !!}`);
        const chartSubjects = JSON.parse(`{!! $subjects !!}`);
        const chartData = JSON.parse(`{!! $data !!}`);
    </script>

    <script src="{{ asset('js/chart.js') }}"></script>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
