<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>トップ画面</title>
    <style>
        body { 
            font-family: "Nunito", sans-serif;
            font-weight: 200;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .explanation {
            background-color: #fff;
            width: 50%;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 2rem;
            padding: 1rem;
            max-width: 1000px;
        }
        .feature {
            background-color: #F0E8DF;
            width: calc(100% / 3);
            padding: 1rem;
            box-sizing: border-box;
        }
        h3 {
            border: 3px solid orange;
            border-radius: 10px;
            text-align: center;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 2rem;
        }
        h4 {
            border: 3px solid orange;
            border-radius: 10px;
            font-size: 1.4rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        img {
            object-fit: cover;
        }
        p {
            font-size: 0.9rem;
            text-align: center;
            margin-top: 1rem;
        }
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        button {
            width: 10rem;
            height: 2.5rem;
            padding: 0.5rem;
            margin: 1rem;
        }
        
        /* メディアクエリ */
    @media (max-width: 768px) {
        .feature {
            width: 100%;
        }
    }
    </style>
</head>
<body>
    <div class="explanation">
        <h3>StudyTimeとは</h3>
        <p>学習を効果的に管理し、
        <p>直近の学習の進捗を追跡するための便利な学習記録アプリです。</p>
        <p>学習時間を記録することで学習の習慣化を促し、</p>
        <p>学習のモチベーションを維持することができます。</p>
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

    <div class="button-container">
        <button type="button" class="btn-blue" onclick="location.href='/login';">
            ログイン画面へ
        </button>

        <button type="button" class="btn-black" onclick="location.href='/register';">
            新規登録画面へ
        </button> 
    </div>
</body>
