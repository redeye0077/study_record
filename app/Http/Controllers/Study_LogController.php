<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Study_LogController extends Controller
{
    public function index()
    {
        return view('study_log');
    }
}
