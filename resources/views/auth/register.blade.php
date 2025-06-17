<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>登録</title>
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
        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 600px;
            padding: 2rem;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .new {
            width: 30rem;
            height: 10rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .blue-button {
            background-color: #3c81f6;
            color: white;
            text-align: center;
            font-size: 1.0rem;
            width: 10rem;
            height: 2.5rem;
            display: flex;
            justify-content: center;
            margin: 2rem 0.5rem 0 0.5rem;; 
        } 
        .blue-button:hover {
            background-color: #254ED8;
        }
        .login {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-top : 2.5rem;
        }
        .login p {
            margin-right: 0.5rem;
        }
        .login a {
            color: #3c81f6;
        }
        /* メディアクエリ */
        @media (max-width: 640px) {
            form {
                width: 80%;
            }
            .new {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>新規登録</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('ログインID')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('メールアドレス')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('パスワード')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('パスワード再入力')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="new">
                <x-primary-button class="blue-button">
                    {{ __('新規登録') }}
                </x-primary-button>
                <div class="login">
                    <p>アカウントをお持ちの場合 → </p>
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('ログイン') }}
                    </a>
                </div>  
            </div>
        </form>
    </div>
</body>
</html> 
