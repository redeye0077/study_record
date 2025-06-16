<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>学習目標を設定する</title>
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
      .target_time input {
        font-size: 1.1rem;
        font-weight: bold;
      }
      p {
        font-size: 1.5rem;
        text-align: center;
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
        justify-content: center;
        margin: 2rem 0.5rem;
      }
      button {
        width: 15rem;
        height: 2.5rem;
        margin: 0.5rem;
      }
      p.message {
        font-size: 1.2rem;
        margin: 2rem 0 0 1rem;
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
    <form method="POST" action="{{ route('study.challenges.new.store') }}">
      @csrf
      <div class="form-group">
        <div class="target_time">
          <p>今月の目標時間</p>
            <input type="text" name="target_hour" value=""><span>時間</span>
            <input type="text" name="target_minutes" value=""><span>分</span>
        </div>

        @error('target_hour')
          <div class="text-sm text-red-600">
            <p class="message">{{ $message }}</p>
          </div>
        @enderror
        
        @error('target_minutes')
          <div class="text-sm text-red-600">
            <p class="message">{{ $message }}</p>
          </div>
        @enderror
      </div>

      <div class="button-container">
        <button type="submit" class="btn-blue">設定する</button>
        <button type="button" class="btn-red" onclick="location.href='/index';">
          キャンセル
        </button>
      </div>
    </form>
  </div>
</body>
</html>
