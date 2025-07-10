@extends('layouts.app')

@section('title', 'メイン画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="body-wrapper">
    <div class="screen">
        <h1>StudyTime</h1>
        <div class="button-container">
            <button type="button" class="btn-blue" onclick="location.href='/study_log';">
                勉強を記録する
            </button>
            <button type="button" class="btn-blue" onclick="location.href='/calendar';">
                学習時間の表示
            </button>
            <button type="button" class="btn-blue" onclick="location.href='/study_challenges/new';">
                目標を設定する
            </button>
            <button type="button" class="btn-blue" onclick="location.href='/chat';">
                掲示板画面
            </button>
            <button type="button" class="btn-blue" onclick="location.href='/settings';">
                設定
            </button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-red">
                    {{ __('ログアウトする') }}
                </button>
            </form>
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
@endsection
