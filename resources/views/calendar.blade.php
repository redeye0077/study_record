@extends('layouts.app')

@section('title', 'メイン画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
@endsection

@section('content')
<div class="chart-wrapper">
    <h1>学習時間</h1>
    
    <div style="width: 80%; height: 500px">
        <canvas id="myChart"></canvas>
    </div>

    <button type="button" class="btn-red" onclick="location.href='/index';">
        メイン画面に戻る
    </button>
</div>

<script>
    const chartDates = JSON.parse(`{!! $dates !!}`);
    const chartSubjects = JSON.parse(`{!! $subjects !!}`);
    const chartData = JSON.parse(`{!! $data !!}`);
</script>

<script src="{{ asset('js/chart.js') }}"></script>
@endsection
