<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>ログインIDを変更する</title>
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
        label {
            font-size: 1rem;
            text-align: center;
        }
        input {
            width: 15rem;
            height: 2rem;
            margin: 0.5rem;
        }
        .alert {
            font-size: 1.5rem;
            padding: 0 0 1rem 0;
        }
        .message {
            font-size: 1rem;
            text-align: center;
            padding: 1rem 0.5rem 0.5rem 0;
        }
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 1rem;
        }
        button {
            width: 12rem;
            height: 2.5rem;
            margin: 0.5rem;
        }
    </style>
</head>
<body>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('settings.login.id.update') }}" style="text-align:center;">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">新しいログインID</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->name }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <div class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        <p class="message">{{ $message }}</p>
                    </div>
                </span>
            @enderror
        </div>

        <div class="button-container">
            <button type="submit" class="btn-blue">
                変更する
            </button>
            <button type="button" class="btn-red" onclick="location.href='/settings';">
                キャンセル
            </button>
        </div>
    </form>
</body>
</html>
