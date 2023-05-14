<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingsWithdrawalController extends Controller
{
    public function index()
    {
        return view('settings_withdrawal');
    }

/**
     * Delete the user's account.
     */
    public function withdrawal(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->studies()->delete();
            $user->monthlyGoals()->delete();
            $user->forceDelete();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('success', '退会処理が完了しました。');
        } else {
            return redirect()->route('login')->with('error', 'ログインしていません。');
        }
    }
}
