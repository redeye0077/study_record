<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>学習記録アプリ</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
  <form method="POST" action="{{ route('study.log.store') }}">
    @csrf

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
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
    
    <div>
      <label for="date">学習日</label>
      <input type="text" name="date" id="date">
    </div>
    <div>
      <label for="subject">学習内容</label>
      <input type="text" name="subject" id="subject">
    </div>
    <div>
      <label for="study_log_hour">学習時間</label>
      <input type="number" name="hour" id="hour" min="0" max="24">時間
      <input type="number" name="minutes" id="minutes" min="0" max="59">分
    </div>
    <button type="submit" class="btn_study_log">記録する</button>
  </form>
  <a href="/index">メイン画面に戻る</a>

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
