<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <title>退会する</title>
    <style>
      body {
        background-color: #f5f5f5;
        font-family: "Nunito", sans-serif;
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
        font-size: 2rem;
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
  @if(session('error'))
    <div class="alert alert-danger text-sm text-red-600 dark:text-red-400 space-y-1">
        {{ session('error') }}
    </div>
  @endif
    <h1>「退会する」のボタンを押すと</h1>
    <h1>退会が完了いたします。</h1>
    <h1>本当に退会してもよろしいですか？</h1>

    <div class="button-container">
        <form action="{{ route('settings.withdrawal.post') }}" method="post">
          @csrf
          @method('POST')
          <button type="submit" class="btn-red">退会する</button>
        </form>
      
        <button type="button" class="btn-blue" onclick="location.href='/settings';">
          キャンセル
        </button>
      </div>      
</body>
</html>
