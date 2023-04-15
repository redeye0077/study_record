<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>メイン画面</title>
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
            text-align: center;
            margin-top: 0;
            margin-bottom: 1rem;
            font-size: 3rem;
        }
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 1rem;
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
    <h1>Study Time</h1>
    <div class="button-container">
        <button type="button" class="btn-blue" onclick="location.href='/study_log';">
            勉強を記録する
        </button>
        <button type="button" class="btn-blue" onclick="location.href='/calendar';">
            学習時間の表示
        </button>
        <button type="button" class="btn-blue" onclick="location.href='/study_challenges';">
            目標
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
</body>
</html>
