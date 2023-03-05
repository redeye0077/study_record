<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyLogController extends Controller
{
    public function index()
    {
        return view('study_log');
    }
}
