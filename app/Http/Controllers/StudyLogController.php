<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StudyLogRequest;
use App\Models\StudyLog;

class StudyLogController extends Controller
{
    public function index()
    {
        return view('study_log');
    }

    public function store(StudyLogRequest $request)
    {
        //フォームから入力値を取得する
        $hour = $request->input('hour');
        $minutes = $request->input('minutes');
        $subject = $request->input('subject');
        $date = $request -> input('date');

        //StudyLogモデルを使ってDBに保存する
        $studyLog = new StudyLog();
        $studyLog->user_id = auth()->user()->id;
        $studyLog->hour = $hour;
        $studyLog->minutes = $minutes;
        $studyLog->duration = $hour * 60 + $minutes;
        $studyLog->subject = $subject;
        $studyLog->date = $date;
        $studyLog->save();

        ///study_logに戻る
        return redirect('/index')->with('success', '学習記録が正常に保存されました！');
    }
}
