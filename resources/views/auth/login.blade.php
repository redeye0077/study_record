<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>ログイン</title>
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
        .alert {
            font-size: 1.5rem;
            width: 20rem;
            height: 2rem;
            margin: 0.5rem;
            padding: 0 0 3rem 0;
            text-align: center;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .login-form {
            width: 30rem;
            height: 10rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 1rem;
        }
        button {
            width: 8rem;
            height: 2.5rem;
            margin: 1rem 0.5rem;
        }
        button[type="submit"] {
            background-color: #3c81f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 1rem 0.5rem;
            width: 11rem;
            font-size: 1.0rem;
        }
        button[type="submit"]:hover {
            background-color: #254ED8;
        }
        /* メディアクエリ */
        @media (max-width: 640px) {
            .button-container {
                flex-direction: column;
                align-items: center;
            }
            button {
                margin: 1rem 0.5rem;
            }
        }
    </style>
</head>
<body>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif    

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1>ログイン</h1>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
    
        <div class="login-form">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('ログインID')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('パスワード')" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>
    
        <div class="button-container">
            <x-primary-button class="ml-3">
                {{ __('ログイン') }}
            </x-primary-button>
    
            <button type="button" class="btn-black" onclick="location.href='/register';">
                新規登録
            </button> 
        </div>    
    </form>
</body>
</html>
