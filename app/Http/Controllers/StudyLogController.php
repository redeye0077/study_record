<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudyLogRequest;
use App\Models\Study;

class StudyLogController extends Controller
{
    public function index()
    {
        return view('study_log');
    }

    public function store(StudyLogRequest $request)
    {
        $data = $request->validated();
        
        $data['user_id'] = $request->user()->id;
        $data['duration'] = ($data['hour'] * 60) + $data['minutes'];

        Study::create($data);

        // study_logに戻る
        return redirect('/index')->with('success', '学習記録が正常に保存されました！');
    }
}
