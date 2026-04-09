<?php

namespace App\Http\Controllers;

use App\Models\MonthlyGoal;
use App\Http\Requests\StudyChallengesNewRequest;

class StudyChallengesNewController extends Controller
{
    public function index()
    {
        return view('study_challenges_new');
    }

    public function store(StudyChallengesNewRequest $request)
    {
        MonthlyGoal::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'month' => now()->startOfMonth()->toDateString(),
            ],
            [
                'achieved' => false,
                'target_hour' => $request->input('target_hour'),
                'target_minutes' => $request->input('target_minutes'),
            ]
        );

        ///study_challengesに戻る
        return redirect('/index')->with('success', '月間目標が正常に保存されました！');
    }
}
