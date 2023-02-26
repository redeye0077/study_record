<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Settings_WithdrawalController extends Controller
{
    public function index()
    {
        return view('settings_withdrawal');
    }

    public function withdrawal(Request $request)
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', '退会処理が完了しました。');
   }
}
