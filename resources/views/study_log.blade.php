<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>勉強を記録する</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
      form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        max-width: 500px;
        width: 100%;
        margin: 1rem;
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
      .study {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        max-width: 500px;
        width: 100%;
        margin: 1rem;
      }
      .study-date,
      .study-contents,
      .learning-date {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        text-align: center;
        max-width: 500px;
        width: 100%;
        margin: 1rem;
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
        justify-content: center;
        margin-top: 1rem;
      }
      button {
        width: 12rem;
        height: 2.5rem;
        margin: 1rem 0.5rem;
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
        button {
          margin-top: 0.5rem;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <form method="POST" action="{{ route('study.log.store') }}">
        @csrf
        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <div class="study">
          <div class="study-date">
            <p>学習日</p>
            <input type="text" name="date" id="date">
          </div>

          <div class="study-contents">
            <p>学習内容</p>
            <input type="text" name="subject" id="subject">
          </div>

          <div class="learning-date">
            <p>学習時間</p>
            <input type="number" name="hour" id="hour" min="0" max="24"><span>時間</span>
            <input type="number" name="minutes" id="minutes" min="0" max="59"><span>分</span>
          </div>
        </div>

        <div class="button-container">
          <button type="submit" class="btn-blue">
            記録する
          </button>
          <button type="button" class="btn-red" onclick="location.href='/index';">
            メイン画面に戻る
          </button>
        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    <script>
      flatpickr("#date", {
        dateFormat: "Y/m/d",
        locale: "ja",
        clickOpens: true,
      });
    </script>
  </body>
</html>
