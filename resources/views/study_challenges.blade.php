<div>
    <p>今月の目標時間<input type="text" name="target_hour" value="{{ $monthlyGoal ? $monthlyGoal->target_hour : '' }}">時間<input type="text" name="target_minutes" value="{{ $monthlyGoal ? $monthlyGoal->target_minutes : '' }}">分</p>
</div>

<div>
    <p>結果<input type="text" name="result_hour" value="">時間<input type="text" name="result_minutes" value="">分</p>
</div>

<a href="/study_challenges/new" class="btn_move_study_challenges_new">今月の目標時間を設定する</a>
<a href="/index" class="btn_return_index">メイン画面に戻る</a>
