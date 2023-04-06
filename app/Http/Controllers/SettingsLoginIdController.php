<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SettingsLoginIdRequest;

class SettingsLoginIdController extends Controller
{
    public function index()
    {
        return view('settings_login_id');
    }

    public function update(SettingsLoginIdRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('settings.login.id')->with('success', '名前を更新しました!');
    }
}
