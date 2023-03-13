<?php

namespace App\Http\Controllers;

use App\Models\MonthlyGoal;
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
        
        return view('study_challenges', compact('monthlyGoal'));
    }
}
