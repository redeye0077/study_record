<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>パスワードを変更する</title>
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
        button[type="submit"] {
        background-color: #3c81f6;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
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
                margin-top: 0.5rem;
            }
        }
    </style>
</head>
<body>
<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')

    <div>
        <x-input-label for="current_password" :value="__('現在のパスワード')" />
        <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password" :value="__('新しいパスワード')" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password_confirmation" :value="__('パスワードの確認')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="button-container">
        <x-primary-button>{{ __('変更する') }}</x-primary-button>

        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('変更しました。') }}</p>
        @endif
    </div>
</form>
<button type="button" class="btn-red" onclick="location.href='/settings';">
    キャンセル
</button>
</body>
</html>
