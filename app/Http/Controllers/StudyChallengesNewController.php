<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyChallengesNewController extends Controller
{
    public function index()
    {
        return view('study_challenges_new');
    }
}
