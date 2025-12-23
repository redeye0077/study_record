<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\MonthlyGoal;
use App\Models\Study;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentMonth = Carbon::now()->startOfMonth();
        
        //monthly_goal_tableに保存されているtarget_hourとtarget_minutesを取得する
        $monthlyGoal = MonthlyGoal::where('user_id', $user->id)
        ->whereDate('month', $currentMonth)
        ->select(['target_hour', 'target_minutes'])
        ->latest('updated_at')
        ->first();

        // 目標時間の合計
        $targetHours = 0;
        if ($monthlyGoal) {
            $targetHours = ($monthlyGoal->target_hour * 60) + $monthlyGoal->target_minutes;
        }

        // studiesテーブルに保存されている月の総勉強時間を取得する
        $totalStudyTime = Study::where('user_id', $user->id)
        ->where('date', 'like', Carbon::now()->format('Y-m') . '%')
        ->sum('duration');

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
        $studies = DB::table('studies')
        ->select('date', 'subject', DB::raw('SUM(hour * 60 + minutes) as duration'))
        ->where('user_id', Auth::id())
        ->groupBy('date', 'subject')
        ->orderBy('date', 'asc')
        ->get();

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

        //ビューに渡す
        return view('index', compact('dates', 'subjects', 'data', 'monthlyGoal', 'targetHours', 'resultHour', 'resultMinutes', 'achievementRate', 'progressRate'));
    }
}
