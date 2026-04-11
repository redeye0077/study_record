<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\MonthlyGoal;
use App\Models\Study;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        //monthly_goal_tableに保存されているtarget_hourとtarget_minutesを取得する
        $monthlyGoal = $this->getMonthlyGoal($user->id);

        // 目標時間の合計
        $targetHours = 0;
        if ($monthlyGoal) {
            $targetHours = ($monthlyGoal->target_hour * 60) + $monthlyGoal->target_minutes;
        }

        // studiesテーブルに保存されている月の総勉強時間を取得する
        $totalStudyTime = $this->getMonthlyStudyTime($user->id);

        // 総勉強時間を時と分に分解する
        $resultHour = floor($totalStudyTime / 60);
        $resultMinutes = $totalStudyTime % 60;

        // 達成率
        $achievementRate = 0;
        if ($targetHours > 0) {
            $achievementRate = round(($totalStudyTime / $targetHours) * 100);
        }

        // 達成率(バー表示用)
        $rate = $achievementRate;
        $progressRate = min(max($rate, 0), 100);
        
        // studiesテーブルから日付と学習時間を取得
        $studies = $this->getStudies($user->id);

        //日付と科目を配列に格納
        $dates = [];
        $subjects = [];
        $data = [];

        //日付ごとにデータを集計
        foreach ($studies as $study) {
            $data[$study->date][] = [
                'subject' => $study->subject,
                'duration' => $study->duration,
            ];
        }

        // 日付を配列に追加する
        foreach ($data as $date => $value) {
            $dates[] = $date;
        }

        //科目を配列に追加する
        foreach ($data as $date => $value) {
            foreach ($value as $subject) {
                $subjects[] = $subject['subject'];
            }
        }

        //重複を削除
        $dates = array_unique($dates);
        $subjects = array_unique($subjects);
 
        //配列をソート
        sort($dates);
        sort($subjects);
 
        //配列をJSON形式に変換
        $dates = json_encode($dates);
        $subjects = json_encode($subjects);
        $data = json_encode($data);

        // 進捗機能の判定
        $actual = $totalStudyTime;
        $goal   = $targetHours;
        $today = now();
        $elapsedDays = $today->day;
        $pace = 0;
        $projected = 0;
        // 総日数
        $totalDaysInMonth = $today->daysInMonth;

        if ($goal <= 0) {
            $status = 'no_goal';
        } elseif ($actual >= $goal) {
            $status = 'done';
        } else {
            // 平均学習時間
            $pace = $elapsedDays > 0 ? $actual / $elapsedDays : 0;
            // 月学習時間の予測
            $projected = $pace * $totalDaysInMonth;

            if ($projected >= $goal) {
                $status = 'good';
            } else {
                $status = 'hard';
            }
        }

        //ビューに渡す
        return view('index', compact('dates', 'subjects', 'data', 'monthlyGoal', 'targetHours', 'resultHour', 'resultMinutes', 'achievementRate', 'progressRate', 'status', 'actual', 'goal', 'pace', 'projected'));
    }

    // studiesテーブルに保存されている月の総勉強時間を取得する
    private function getMonthlyStudyTime(int $userId)
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        return Study::where('user_id', $userId)
            ->whereBetween('date', [$start, $end])
            ->sum('duration');
    }

    //monthly_goal_tableに保存されているtarget_hourとtarget_minutesを取得する
    private function getMonthlyGoal(int $userId)
    {
        $currentMonth = Carbon::now()->startOfMonth();
        
        return MonthlyGoal::where('user_id', $userId)
        ->whereDate('month', $currentMonth)
        ->select(['target_hour', 'target_minutes'])
        ->latest('updated_at')
        ->first();
    }

    // studiesテーブルから日付と学習時間を取得
    private function getStudies(int $userId)
    {
        return Study::where('user_id', $userId)
        ->selectRaw('date, subject, SUM(hour * 60 + minutes) as duration')
        ->groupBy('date', 'subject')
        ->orderBy('date', 'asc')
        ->get();
    }

}
