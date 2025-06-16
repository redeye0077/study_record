<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>設定画面</title>
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
            width: 15rem;
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
    <h1>設定</h1>
    <div class="button-container">
        <button type="button" class="btn-blue" onclick="location.href='/settings/login_id';">
            ログインIDを変更する
        </button>
        <button type="button" class="btn-blue" onclick="location.href='/settings/password';">
            パスワードを変更する
        </button>
        <button type="button" class="btn-red" onclick="location.href='/index';">
            メイン画面に戻る
        </button>
        <button type="button" class="btn-red" onclick="location.href='/settings/withdrawal';">
            退会する
        </button>
    </div>
</body>
</html>
