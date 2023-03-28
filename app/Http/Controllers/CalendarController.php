<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // studiesテーブルから日付と学習時間を取得
        $studies = DB::table('studies')
        ->select('date', 'subject', DB::raw('SUM(hour * 60 + minutes) as duration'))
        ->where('users_id', Auth::id())
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

        //日付を配列に追加する
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
        return view('calendar', compact('dates', 'subjects', 'data'));
    }
}
