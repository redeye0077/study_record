<form method="POST" action="{{ route('study.challenges.new.store') }}">
    @csrf
    <div>
        <p>今月の目標時間<input type="text" name="target_hour" value="">時間<input type="text" name="target_minutes" value="">分</p>
    </div>

    <button type="submit" class="btn_set_goal">設定する</button>
</form>
<a href="/study_challenges" class="btn_return_study_challenges_new">目標画面に戻る</a>
