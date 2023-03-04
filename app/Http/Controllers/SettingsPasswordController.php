<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsPasswordController extends Controller
{
    public function index()
    {
        return view('SettingsPassword');
    }
}
