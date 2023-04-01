<?php

namespace App\Http\Controllers;

use App\Models\MonthlyGoal;
use App\Models\Study;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudyChallengesController extends Controller
{
    public function index()
    {   
        //monthly_goal_tableに保存されているtarget_hourとtarget_minutesを取得する
        $monthlyGoal = MonthlyGoal::latest('updated_at')
        ->where('month', Carbon::now()->format('Y-m') . '-01')
        ->first(['target_hour', 'target_minutes']);

        // studiesテーブルに保存されている月の総勉強時間を取得する
        $totalStudyTime = Study::where('date', 'like', Carbon::now()->format('Y-m') . '%')
        ->sum('duration');

        // 総勉強時間を時と分に分解する
        $resultHour = floor($totalStudyTime / 60);
        $resultMinutes = $totalStudyTime % 60;
        
        return view('study_challenges', compact('monthlyGoal', 'resultHour', 'resultMinutes'));
    }
}
