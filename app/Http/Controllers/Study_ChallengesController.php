<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Study_ChallengesController extends Controller
{
    public function index()
    {
        return view('study_challenges');
    }
}
