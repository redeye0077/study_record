<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Study_Challenges_NewController extends Controller
{
    public function index()
    {
        return view('study_challenges_new');
    }
}
