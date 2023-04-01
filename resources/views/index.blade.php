<h1>index</h1>
<a href="/subject" class="btn_subject">学習内容一覧</a>
<a href="study_log" class="btn_study_log">勉強を記録する</a>
<a href="/share" class="btn_share">共有</a>
<a href="/calendar" class="btn_calendar">学習時間の表示</a>
<a href="/study_challenges" class="btn_study_challenges">目標</a>
<a href="/settings" class="btn_settings">設定</a>
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
        {{ __('ログアウトする') }}
    </button>
</form>
