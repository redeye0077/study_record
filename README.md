# 制作背景

サービスの概要は、学習を効果的に管理し、直近の学習の進捗を追跡するための便利な学習記録アプリです。想定しているユーザーは高校、大学の受験生や学習する習慣がある人を想定しています。目標設定や学習記録を可視化することでユーザーのモチベーションを高め、学習の継続を支援するという課題を解決することを目指して作りました。
<br>
<br>

## URL

- URL: https://studyrecord.net
<br>
Qiitaに詳細を執筆しております。<br>
<a href="https://qiita.com/sapphire_19/items/2f4a6aad7569a38a39ae">未経験者がLaravelでポートフォリオを作成してみた</a>
<br>
<br>

## ER図

<img width="1378" height="1068" alt="Image" src="https://github.com/user-attachments/assets/54eef969-1f9b-4ac4-bff0-d234859e8a18">
<br>
<br>


## インフラ構成図

<img width="1032" alt="インフラ構成図" src="https://github.com/user-attachments/assets/95956f74-87db-4e36-822f-ff50d6c0c152">
<br>
<br>

## 使用技術

1.フロントエンド
- HTML
- CSS
- Tailwind CSS

2.バックエンド
- PHP 8.4.6
- Laravel 11.44.7
- JavaScript

3.使用ライブラリ
- Chart.js
- FullCalendar
- Laravel Breeze

4.データベース
- MySQL

5.インフラ
- AWS(VPC / EC2 / Route53 / RDS)
- Let's Encrypt

<br>
<br>

## 機能一覧

<table border="1">
    <tr>
        <th></th>
        <th>機能</th>
    </tr>
    <tr>
        <td>1</td>
        <td>アカウント登録機能</td>
    </tr>
    <tr>
        <td>2</td>
        <td>アカウント削除機能</td>
    </tr>
    <tr>
        <td>3</td>
        <td>ログイン機能</td>
    </tr>
    <tr>
        <td>4</td>
        <td>ログアウト機能</td>
    </tr>
    <tr>
        <td>5</td>
        <td>学習記録機能</td>
    </tr>
    <tr>
        <td>6</td>
        <td>学習記録表示機能</td>
    </tr>
    <tr>
        <td>7</td>
        <td>月間目標機能</td>
    </tr>
     <tr>
        <td>8</td>
        <td>掲示板機能</td>
    </tr>
    <tr>
        <td>9</td>
        <td>ログインID変更機能</td>
    </tr>
    <tr>
        <td>10</td>
        <td>パスワード変更機能</td>
    </tr>
</table>

<br>
<br>
<br>

# 何ができるのか

1.トップページ
<br>

<img width="1422" alt="トップページ" src="https://github.com/redeye0077/study_record/assets/88723527/4eb8a3ee-48b7-4166-95b7-62125cd3e9cc">

- アプリの使い方や説明を記載しています。

<br>
<br>

2.ユーザー認証
<br>

<img width="585" alt="ログイン画面" src="https://github.com/redeye0077/study_record/assets/88723527/d894713f-db16-4221-89af-e87f01eda9f8">

<br>

- アカウント登録済みの場合はフォームにログインIDとパスワードを入力してログイン。
<br>
<br>
<br>

3.ユーザー登録
<br>
<br>

![新規登録gif](https://github.com/redeye0077/study_record/assets/88723527/ab44c649-6400-4234-a73b-9b9e53416193)

<br>
<br>

- ログインID、メールアドレス、パスワードを入力して登録。

- メールアドレスに認証メールが送信されます。

- 認証メールのリンクをクリックすると登録完了します。

- バリデーション
    - ログインID、メールアドレス、パスワードは必須項目
    - ログインIDとパスワードは半角英数字で入力
    - メールアドレスは正しい形式で入力
    - パスワードは8文字以上の入力が必須
    - パスワードは確認用のパスワードと一致するように入力
<br>
<br>


4.学習記録機能
<br>

<img width="756" alt="学習記録画面" src="https://github.com/redeye0077/study_record/assets/88723527/59f6ba60-fb42-4d94-a083-3cd003056ea0">

<br>

- 学習時間、学習内容、学習日を入力して学習記録を作成します。

- バリデーション
    - 学習時間、学習内容、学習日は必須項目
    - 学習時間は半角数字で入力
    - 学習内容は100文字以内で入力
    - 学習日は日付形式で入力
<br>
<br>

5.学習記録表示機能
<br>

<img width="790" alt="study_graph" src="https://github.com/redeye0077/study_record/assets/88723527/3e7678f5-9e69-489a-b3f3-f60612eb5a8c">

<br>

- 学習記録をカレンダーで表示。

- 学習時間、学習内容、学習日を確認することができます。
<br>
<br>

6.月間目標機能
<br>
<br>

![目標gif](https://github.com/redeye0077/study_record/assets/88723527/67273943-5b1d-444c-a782-ded5aca5f577)

<br>
<br>

- 月間目標を設定することができます。

- 学習目標時間と学習結果時間を比較することで、目標の達成度を確認することができます。

- バリデーション
    - 学習目標時間は半角数字で入力
    - 学習目標時間は必須項目
<br>
<br>

7.掲示板機能
<br>

<img width="500" height="565" alt="Image" src="https://github.com/user-attachments/assets/e2016f6e-7979-4fa9-b5f7-d234f00511f6">

<br>

- ユーザーが自由にメッセージを投稿し、時系列で古い順番から一覧表示される形で閲覧できます。

- メッセージ投稿
    - フォームから投稿内容を入力して送信可能
    - 投稿後は即時リストに反映

<br>

- メッセージ一覧表示
    - 各投稿には「投稿日時」「ユーザー名」「内容」が表示されます。
    - 投稿者ごとに吹き出しの色分けを行っており、視認性を高めています。
        - 自分の投稿：グリーン系
        - 他ユーザーの投稿：ブルー系

<br>

- ページネーション
    - 投稿は10件ごとに分割して表示
    - 下部にページナビゲーションがあり、過去ログも容易に閲覧可能
 
<br>
 
- バリデーション
    - メッセージは必須項目
    - メッセージは100文字以内で入力   

<br>
<br>

8.ログインID変更機能
<br>

<img width="549" alt="ログインID変更" src="https://github.com/redeye0077/study_record/assets/88723527/96b6aa5f-5664-4af9-93d7-6173cc2151af">

<br>

- 現在のログインIDが表示されています。

- 新しいログインIDを入力して変更します。

- バリデーション
    - 新しいログインIDは必須項目
    - 新しいログインIDは半角英数字で入力
    - 新しいログインIDは既に登録されているログインIDと重複しないように入力
<br>
<br>

9.パスワード変更機能
<br>

<img width="506" alt="パスワード変更" src="https://github.com/redeye0077/study_record/assets/88723527/ab3acaa8-f166-4d47-b74b-43fb1f0a9b25">

<br>

- 新しいパスワードを入力して変更します。

- バリデーション
    - 新しいパスワードは必須項目
    - 新しいパスワードは8文字以上で入力
    - 新しいパスワードは半角英数字で入力
    - 新しいパスワードは確認用のパスワードと一致するように入力
<br>
<br>

10.アカウント削除機能
<br>
<br>

![退会gif](https://github.com/redeye0077/study_record/assets/88723527/a94abf6b-9280-4b0c-9dd3-06f89df461ae)

<br>
<br>

- 退会するボタンを押すとアカウントを削除することができます。
