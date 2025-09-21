@extends('layouts.app')

@section('title', 'トップ画面')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
<header class="site-header" id="header">
    <img src="/images/studyrecord_logo.png" alt="StudyRecord" class="logo-img" width="250" height="30">
    {{-- PC用メニュー --}}
    <ul class="header-button pc-menu">
        <li>
            <form method="POST" action="{{ route('guest.login') }}">
                @csrf
                <button type="submit" class="btn-guest">
                    ゲストログイン
                </button>
            </form>
        </li>
        <li>
            <button type="button" class="btn-login" onclick="location.href='/login';">
                ログイン
            </button>
        </li>
        <li>
            <button type="button" class="btn-login" onclick="location.href='/register';">
                新規登録
            </button> 
        </li>
    </ul>
    {{-- スマホ時のみ表示されるハンバーガーボタン --}}
    <button class="hamburger" id="menuBtn" aria-expanded="false" aria-label="メニュー切り替え">
        ☰
    </button>
</header>
{{-- スマホ用メニュー --}}
<div class="mobile-menu hidden" id="mobileMenu">
  <ul class="header-button sm-menu">
    <li>
        <form method="POST" action="{{ route('guest.login') }}">
            @csrf
            <button type="submit" class="btn-guest">
                ゲストログイン
            </button>
        </form>
    </li>
    <li>
        <button type="button" class="btn-login" onclick="location.href='/login';">
            ログイン
        </button>
    </li>
    <li>
        <button type="button" class="btn-login" onclick="location.href='/register';">
            新規登録
        </button>
    </li>
  </ul>
</div>
<div class="features">
    <div class=main>
        <div class=main-text>
            <h1>StudyRecord</h1>
            <h2>学習の進捗を追跡するための</h2>
            <h2>学習記録アプリ</h2>
        </div>
        <img src="/images/studyrecord_top.png" alt="StudyRecord" class="top-img" width="250" height="30">
    </div>
    <div class="feature">
        <div class="feature-block">
            <div class="feature-text">
                <h4>学習記録機能</h4>
                <p>学習記録機能では、学習時間を記録することが</p>
                <p>できます。</P>
                <p>学習時間を記録することで学習の習慣化を促し、</p>
                <p>学習のモチベーションを維持することができます。</p>
            </div>
            <img src="/images/study_log.png" alt="StudyRecord" class="log-img" width="250" height="30">
        </div>
        <div class="feature-block">
            <img src="/images/study_graph.png" alt="StudyRecord" class="log-img" width="250" height="30">
            <div class="feature-text">
                <h4>学習記録の表示</h4>
                <p>学習時間をグラフで視覚化して</p>
                <p>表示します。</p>
                <p>グラフは最新の7日分の学習時間を表示します。</p>
                <p>それ以上の日数がある場合は、最新の7日分の
                <p>データのみを取得して表示します。</p>
            </div>
        </div>
        <div class="feature-block">
            <div class="feature-text">
                <h4>月間目標機能</h4>
                <p>月間の学習目標を設定することができます。</p>
                <p>学習目標時間と学習結果時間を比較することで、</p>
                <p>目標の達成度を確認することができます。</p>
            </div>
            <img src="/images/target.png" alt="StudyRecord" class="log-img" width="250" height="30">
        </div>
    </div>
</div>
<footer>
    <p>Copyright © StudyRecord</p>
</footer>
<script src="{{ asset('js/menu.js') }}"></script>
@endsection
