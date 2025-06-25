@extends('layouts.app')

@section('title', 'トップ画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
<body>
<div class="upper">
    <div class="header-content-box">
        <div class="absolute inset-0 flex flex-col justify-center items-center text-white bg-black bg-opacity-50">
            <div class="text-container">
                <h1 class="text-3xl font-bold mb-2">StudyTime</h1>
                <p class="upper-p">学習記録アプリ</p>
            </div>

            <div class="button-upper-conteiner" style="display: flex; justify-content: center;">
                <button type="button" class="btn-blue" onclick="location.href='/login';">
                    ログイン
                </button>

                <form method="POST" action="{{ route('guest.login') }}" style="margin-top: 0.5rem;">
                    @csrf
                    <button type="submit" class="btn-red mt-2">
                        ゲストログイン
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="features">
    <div class="feature">
        <h4>学習記録機能</h4>
        <img src="{{ asset('images/study_log.png') }}" alt="学習記録機能の画像">
        <p>学習記録機能では、</p>
        <p>学習時間を記録することが</p>
        <p>できます。</P>
        <p>学習時間を記録することで</p>
        <p>学習の習慣化を促し、</p>
        <p>学習のモチベーションを</p>
        <p>維持することができます。</p>
    </div>

    <div class="feature">
        <h4>学習記録の表示</h4>
        <img src="{{ asset('images/study_graph.png') }}" alt="学習記録のグラフ表示の画像">
        <p>学習時間をグラフで視覚化して</p>
        <p>表示します。</p>
        <p>グラフは最新の7日分の</p>
        <p>学習時間を表示します。</p>
        <p>それ以上の日数がある場合は、</p>
        <p>最新の7日分のデータのみを</p>
        <p>取得して表示します。</p>
    </div>

    <div class="feature">
        <h4>月間目標機能</h4>
        <img src="{{ asset('images/target.png') }}" alt="月間目標機能の画像">
        <p>月間の学習目標を</p>
        <p>設定することができます。</p>
        <p>学習目標時間と学習結果時間を
        <p>比較することで、</p>
        <p>目標の達成度を</p>
        <p>確認することができます。</p>
    </div>
</div>
<h3>さぁ、はじめよう！</h3>
<div class="button-container">
    <button type="button" class="btn-blue" onclick="location.href='/login';">
        ログイン
    </button>

    <button type="button" class="btn-black" onclick="location.href='/register';">
        新規登録
    </button> 
</div>
</body>
@endsection
