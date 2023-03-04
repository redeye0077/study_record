<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyChallengesController extends Controller
{
    public function index()
    {
        return view('study_challenges');
    }
}
