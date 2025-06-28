<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsPasswordController extends Controller
{
    public function index()
    {
        return view('settings.password');
    }
}
