<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MonthlyGoal;

class StudyChallengesNewController extends Controller
{
    public function index()
    {
        return view('study_challenges_new');
    }

    public function store(Request $request)
    {
        //フォームから入力値を取得する
        $target_hour = $request->input('target_hour');
        $target_minutes = $request->input('target_minutes');

        //入力値をmonthly_goal_tableに保存する
        DB::table('monthly_goal')->insert([
            'month' => date('Y-m') . '-01',
            'achieved' => false,
            'target_hour' => $target_hour,
            'target_minutes' => $target_minutes,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        ///study_challengesに戻る
        return redirect('/study_challenges')->with('success', 'Monthly goal saved successfully!');
    }
}
