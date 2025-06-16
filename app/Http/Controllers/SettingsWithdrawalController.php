<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SettingsWithdrawalRequest;
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
    public function withdrawal(SettingsWithdrawalRequest $request)
    {
        $user = Auth::user();
        $guestUserId = 1;
        
        if ($user->id === $guestUserId) {
            return redirect()->route('settings.withdrawal.index')->with('error', 'ゲストユーザーは退会できません。');
        }

        if ($user) {
            $user->studies()->delete();
            $user->monthlyGoals()->delete();
            $user->forceDelete();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('welcome');
        } else {
            return redirect()->route('welcome');
        }
    }
}
