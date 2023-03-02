<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Settings_Login_IDController extends Controller
{
    public function index()
    {
        return view('settings_login_id');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
        ]);
        
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('settings.login_id')->with('success', '名前を更新しました');
    }
}
