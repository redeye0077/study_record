<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Settings_WithdrawalController extends Controller
{
    public function index()
    {
        return view('settings_withdrawal');
    }
}
