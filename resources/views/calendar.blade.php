<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>学習時間カレンダー</title>
    {{-- Chart.jsの読み込み --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
          background-color: #f5f5f5;
          font-family: 'Nunito', sans-serif;
          font-weight: 200;
          margin: 0;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          height: 100vh;
        }
        h1 {
        font-size: 2rem;
        margin-bottom: 1rem;
        }
        button {
            width: 10rem;
            height: 2.5rem;
            margin: 0.5rem;
        }

        /* メディアクエリ */
        @media (max-width: 640px) {
            .button-container {
                flex-direction: column;
                align-items: center;
            }
            button {
                margin-top: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <h1>学習時間</h1>
    <canvas id="myChart"></canvas>
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
    <button type="button" class="btn-red" onclick="location.href='/index';">
        メイン画面に戻る
    </button>
</body>
</html>
