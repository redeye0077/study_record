<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>月の学習目標の結果</title>
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
        .container {
            padding: 2rem;
            border-radius: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin: 1rem;
        }
        input {
            width: 6rem;
            height: 3rem;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
            border: none;
            background-color: #f5f5f5;
            text-align: center;
        }
        .target-label input {
            font-size: 1.1rem;
            font-weight: bold;
        }
        .result input {
            font-size: 1.1rem;
            font-weight: bold;
        }
        p {
            font-size: 1.5rem;
            text-align: left;
            padding: 1rem 0;
            margin: 1rem;
        }
        span {
            font-size: 1.4rem;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 1rem;
        }
        button {
            width: 15rem;
            height: 2.5rem;
            margin: 0.5rem;
        }

        /* メディアクエリ */
        @media (max-width: 640px) {
            .container {
                padding: 1rem;
            }
            .button-container {
                flex-direction: column;
                align-items: center;
            }
            input {
                width: 4rem;
            }
            button {
                margin-top: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="target-label">
            <p>今月の目標時間</p>
            <input type="text" name="target_hour" value="{{ $monthlyGoal ? $monthlyGoal->target_hour : '' }}"><span>時間</span>
            <input type="text" name="target_minutes" value="{{ $monthlyGoal ? $monthlyGoal->target_minutes : '' }}"><span>分</span>
        </div>
    
        <div class="result">
            <p>結果</p>
            <input type="text" name="result_hour" value="{{ $resultHour }}" readonly><span>時間</span>
            <input type="text" name="result_minutes" value="{{ $resultMinutes }}" readonly><span>分</span>
        </div>
    
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="button-container">
        <button type="button" class="btn-blue" onclick="location.href='/study_challenges/new';">
            今月の目標時間を設定する
        </button>
        <button type="button" class="btn-red" onclick="location.href='/index';">
            メイン画面に戻る
        </button>
    </div>
</div>
</body>
</html>
