<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>トップ画面</title>
    <style>
        h1 {
            font-size: 3rem;
            color: #329e9e;
            margin-bottom: 0.5rem;
        }
        .upper-p {
            font-size: 1.5rem;
            color: #329e9e;
            margin-bottom: 1rem;
        }
        .text-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        body { 
            font-family: "Nunito", sans-serif;
            font-weight: 200;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            width : 100%;
            justify-content: center;
            margin: 0.5rem;
            padding: 0.5rem;
        }
        .feature {
            background-color: #F1F5F8;
            color: #329e9e;
            width: calc(33.33% - 1.6rem);
            margin: 5rem 0.8rem 0.8rem 0.2rem;
            padding: 1rem;
            box-sizing: border-box;
            flex-direction: column;
            align-items: center;
            display: flex;
        }
        h3 {
            text-align: center;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 2rem;
            color: #329e9e;
        }
        h4 {
            font-size: 1.4rem;
            color: #329e9e;
            text-align: center;
            margin-bottom: 1rem;
        }
        img {
            object-fit: cover;
        }
        .aaa {
            background-image: url("{{ asset('images/learning_photo.png') }}");
            background-size: cover;
            background-position: 50%;
            background-repeat: no-repeat;
            width: 100vw;
            height: 50vh;
            position: relative;       
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
            margin-bottom: 5rem;
        }
        .button-upper-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        button {
            width: 10rem;
            height: 2.5rem;
            padding: 0.5rem;
            margin: 1rem;
        }
        
        /* メディアクエリ */
    @media (max-width: 768px) {
        .aaa {
            height: 60vh;
        }

        .features {
            flex-direction: column;
            align-items: center;
        }

        .feature {
            width: 80%;
        }
    }
    </style>
</head>
<body>
    <div class="upper">
        <div class="aaa">
        <div class="absolute inset-0 flex flex-col justify-center items-center text-white bg-black bg-opacity-50">
            <div class="text-container">
                <h1 class="text-3xl font-bold mb-2">StudyTime</h1>
                <p class="upper-p">学習記録アプリ</p>
            </div>
            <div class="button-upper-conteiner" style=
                "display: flex;
                justify-content: center;"
            >
                <button type="button" class="btn-green" onclick="location.href='/login';">
                    ログイン
                </button>
                <form method="POST" action="{{ route('guest.login') }}" style="
                    margin-top: 0.5rem;"
                >
                    @csrf
                    <button type="submit" class="btn-red mt-2">
                        ゲストログイン
                    </button>
                </form>
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
        <button type="button" class="btn-green" onclick="location.href='/login';">
            ログイン
        </button>

        <button type="button" class="btn-black" onclick="location.href='/register';">
            新規登録
        </button> 
    </div>
</body>
