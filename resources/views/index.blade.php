@extends('layouts.app')

@section('title', 'メイン画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<body>
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
        <div style="width: 100%; height: 500px">
            <canvas id="myChart"></canvas>
        </div>

        <script>
            // ビューから渡されたデータを変数に代入
            const dates = JSON.parse(`{!! $dates !!}`);
            const subjects = JSON.parse(`{!! $subjects !!}`);
            const data = JSON.parse(`{!! $data !!}`);

            //最新の7日分の日付を取得
            const truncatedDates = dates.slice(Math.max(dates.length - 7, 0));

            //日付ごとの学習時間を集計
            const datasets = subjects.map((subject) => {
                // 各科目に対して、日付ごとの学習時間の配列を作成する
                const SubjectData = truncatedDates.map(date => {
                    // 各日付における各科目の学習時間を取得する
                    const record = data[date].find(record => record.subject === subject);
                    // 各日付における各科目の学習時間が存在する場合はその値を、存在しない場合は0を返す
                    return record ? record.duration : 0;
                });
                //科目ごとに異なる色を設定する
                const colors = [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ];
                const borderColor = [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                ];
                const backgroundColor = colors[subjects.indexOf(subject)];
                const borderColors = borderColor[subjects.indexOf(subject)];
                // 日付ごとの学習時間の配列を科目ごとにオブジェクトに格納する
                return {
                    label: subject,
                    data: SubjectData,
                    backgroundColor: backgroundColor,
                    borderColor: borderColors,
                    borderWidth: 1,
                }; 
            });
            
            // グラフの描画
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: truncatedDates,
                    datasets: datasets,
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            stacked : true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return  value +  '分'
                                }
                            },
                            title: {
                                display: true,
                                text: '学習時間'
                            }
                        },
                        x: {
                            stacked: true,
                            title: {
                                display: true,
                                text: '日付'
                            }
                        }
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.yLabel + '時間';
                            }
                        }
                    }
                }
            });
        </script>
    </div>
</body>
@endsection
